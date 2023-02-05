<?php

namespace App\Http\Livewire\Panel\Shooting;

use App\Models\People;
use App\Models\Shooting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Symfony\Component\Finder\SplFileInfo;

class ShootPeople extends Component
{
    /**
     * @var Shooting
     */
    public Shooting $shooting;

    public $allPeople;
    public $selectedPeople;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->checkDirectory();

        $this->allPeople = People::all();
    }

    /**
     * @return void
     */
    public function shootPeople(): void
    {
        $this->moveFiles();

        $this->createPeopleShoot();

        $this->reset('selectedPeople');
    }

    /**
     * @return void
     */
    private function createPeopleShoot(): void
    {
        $people = $this->allPeople->find($this->selectedPeople);

        if (!$people) {
            return;
        }

        $shootedPeople = $this->shooting->people()->find($people);

        if ($shootedPeople) {
            $shootedPeople->pivot->touch('shoot_at');
        } else {
            $this->shooting->people()->save($people, [
                'shoot_at' => now(),
            ]);
        }
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.panel.shooting.shoot-people', [
            'allPeople'   => $this->allPeople,
            'inputFiles'  => $this->getInputFiles(),
            'outputFiles' => $this->getOutputFiles(),
        ]);
    }

    /**
     * @return array
     */
    private function getInputFiles(): array
    {
        return File::files(config('filesystems.disks.inputShooting.root'));
    }

    /**
     * @return array
     */
    private function getOutputFiles(): array
    {
        return File::files($this->buildOutputPath());
    }

    /**
     * @param SplFileInfo $inputFile
     *
     * @return string
     */
    private function buildFileName(SplFileInfo $inputFile): string
    {
        /** @var People $people */
        $people = $this->allPeople->find($this->selectedPeople);

        $people->increment('nbr_photos');

        return implode('', [
            Str::replace(' ', '-', $people->surname),
            '_',
            Str::replace(' ', '-', ucwords($people->name)),
            '-',
            Str::replace(' ', '-', Str::upper($people->role->name)),
            '-',
            $people->nbr_photos,
            '.',
            $inputFile->getExtension(),
        ]);
    }

    /**
     * @param SplFileInfo|null $inputFile
     *
     * @return string
     */
    private function buildOutputPath(?SplFileInfo $inputFile = null): string
    {
        return
            config('filesystems.disks.outputShooting.root')
            . DIRECTORY_SEPARATOR
            . $this->shooting->directoryName
            . DIRECTORY_SEPARATOR
            . (!is_null($inputFile) ? $this->buildFileName($inputFile) : '');
    }

    /**
     * @return void
     */
    private function checkDirectory(): void
    {
        if (!File::exists($this->buildOutputPath())) {
            File::makeDirectory($this->buildOutputPath());
        }
    }

    /**
     * @return void
     */
    private function moveFiles(): void
    {
        foreach (File::allFiles(config('filesystems.disks.inputShooting.root')) as $inputFile) {
            File::move(
                $inputFile->getPathname(),
                $this->buildOutputPath($inputFile),
            );
        }
    }
}
