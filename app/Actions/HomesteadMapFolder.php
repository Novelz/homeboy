<?php

/**
 * @author Studio Zerotredici
*/

namespace App\Actions;

use App\Actions\Interfaces\ActionInterface;
use App\FileManagers\HomesteadFileManager;

class HomesteadMapFolder extends BaseAction implements ActionInterface {

    private $filePath;
    private $domain;
    private $projectPath;

    public function __construct($filePath, $domain, $projectPath, $hostFolder)
    {
		$this->hostFolder = $hostFolder;
        $this->filePath = $filePath;
        $this->domain = $domain;
        $this->projectPath = $projectPath;
    }

    public function confirmationMessage(){
        return '('.$this->filePath.') map : '.$this->hostFolder.' to '.$this->projectPath;
    }

    public function actionMessage(){
        return 'Mapping '.$this->hostFolder.' to "'.$this->projectPath.'"';
    }

    public function run(){
        $fileManager = new HomesteadFileManager($this->filePath);
        $fileManager->addMapLineToFolder($this->hostFolder, $this->projectPath);
    }

}