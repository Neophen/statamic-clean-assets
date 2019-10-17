<?php

namespace Statamic\Addons\CleanAssets;

use Statamic\Extend\Command;

class CleanAssetsCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'clean_assets';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Checks if all exisitng assets are being used in any content files, if not removes them';

  private $contentFiles;
  private $removedAssets;

  /**
   * Create a new command instance.
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    $this->info('Gathering assets...');
    $assets = \Statamic\API\Asset::all();

    $this->info('Reading content files...');
    $this->contentFiles = collect(\Statamic\API\Folder::disk('content')->getFilesRecursively('/'))
      ->map(function ($path) {
        return \Statamic\API\File::disk('content')->get($path);
      });

    foreach ($assets as $asset) {
      if (!$this->assetIsUsed($asset)) {
        $this->removeAsset($asset);
      }
    }

    \Statamic\API\AssetContainer::all()->each(function ($container) {
      foreach ($container->folders() as $path) {
        $folder = $container->assetFolder($path);
        $this->line('Saving folder ' . $folder->path() . '...');
        $folder->save();
      }
    });

    foreach ($this->removedAssets as $asset) {
      $path = $asset->path();
      $this->line('Deleting asset file at ' . $path);

      try {
        $asset->disk()->delete($path);
      } catch (\League\Flysystem\FileNotFoundException $e) {
        //
      }
    }

    $this->info('Removed Assets: ' . count($this->removedAssets));
  }

  private function assetIsUsed($asset)
  {
    $id = $asset->id();
    $url = $asset->uri();

    $this->line(sprintf('Checking %s (%s)...', $id, $url));

    foreach ($this->contentFiles as $contents) {
      if (\Statamic\API\Str::contains($contents, [$id, $url])) {
        return true;
      }
    }

    return false;
  }

  private function removeAsset(\Statamic\Contracts\Assets\Asset $asset)
  {
    $this->info('Removing.');

    $asset->delete();

    $this->removedAssets[] = $asset;
  }
}
