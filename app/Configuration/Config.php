<?php

namespace App\Configuration;

class Config{

    private $composerProject;
    private $useComposer;
    private $folder;
    private $folderSuffix;
    private $domainExtension;
    private $hostIP;
	private $hostsPath;
    private $homesteadPath;
    private $homesteadSitesPath;
    private $homesteadBoxPath;
    private $homesteadAccessDirectoryCommand;
    private $accessLocalSitesDirectoryCommand;
    private $composerGlobal;
    private $dotEnvDirectory;
	private $dotEnvFileName;
	/**013 */
	private $currentOs;

    public function updateFromEnvironment(){
        $this->folder = getenv('LOCAL_SITES_PATH');
        $this->folderSuffix = getenv('DEFAULT_FOLDER_SUFFIX');
        $this->useComposer = boolval(getenv('USE_COMPOSER'));
        $this->composerProject = getenv('DEFAULT_COMPOSER_PROJECT');
        $this->hostsPath = getenv('HOSTS_FILE_PATH');
		$this->hostIP = getenv('HOMESTEAD_HOST_IP');
        $this->homesteadPath = getenv('HOMESTEAD_FILE_PATH');
        $this->homesteadSitesPath = getenv('HOMESTEAD_SITES_PATH');
        $this->homesteadBoxPath = getenv('HOMESTEAD_BOX_PATH');
        $this->homesteadAccessDirectoryCommand = getenv('HOMESTEAD_ACCESS_DIRECTORY_COMMAND');
        $this->domainExtension = getenv('DEFAULT_DOMAIN_EXTENSION');
		$this->accessLocalSitesDirectoryCommand = getenv('ACCESS_LOCAL_SITES_DIRECTORY_COMMAND');
		/**013*/
		$this->currentOs = getenv('CURRENT_OS');
    }

    public function dotEnvFilePath(){
        return $this->getDotEnvDirectory().'/'.$this->getDotEnvFileName();
    }

    public function hasDotEnvFile(){
        return file_exists($this->dotEnvFilePath());
    }

    public function getFolder(){
        return $this->folder;
    }

    public function getFolderSuffix(){
        return $this->folderSuffix;
    }

    public function getUseComposer(){
        return $this->useComposer;
    }

    public function getComposerProject(){
        return $this->composerProject;
    }

    public function setHostsPath($hostsPath){
        $this->hostsPath = $hostsPath;
    }

    public function getHostsPath(){
        return $this->hostsPath;
    }

    public function getHostIP(){
        return $this->hostIP;
    }

    public function setHomesteadPath($homesteadPath){
        $this->homesteadPath = $homesteadPath;
    }

    public function getHomesteadPath(){
        return $this->homesteadPath;
    }

    public function getHomesteadSitesPath(){
        return $this->homesteadSitesPath;
    }

    public function setHomesteadBoxPath($homesteadBoxPath){
        $this->homesteadBoxPath = $homesteadBoxPath;
    }

    public function getHomesteadBoxPath(){
        return $this->homesteadBoxPath;
    }

    public function getHomesteadAccessDirectoryCommand(){
        return $this->homesteadAccessDirectoryCommand;
    }

    public function getDomainExtension(){
        return $this->domainExtension;
    }

    public function getAccessLocalSitesDirectoryCommand(){
        return $this->accessLocalSitesDirectoryCommand;
	}

    public function setComposerGlobal($composerGlobal){
        return $this->composerGlobal = $composerGlobal;
    }

    public function getComposerGlobal(){
        return $this->composerGlobal;
    }

    public function setDotEnvDirectory($dotEnvDirectory){
        $this->dotEnvDirectory = $dotEnvDirectory;
    }

    public function getDotEnvDirectory(){
        return $this->dotEnvDirectory;
    }

    public function setDotEnvFileName($dotEnvFileName){
        $this->dotEnvFileName = $dotEnvFileName;
    }

    public function getDotEnvFileName(){
        return $this->dotEnvFileName;
	}
	
	/** 013 */
	public function getCurrentOs(){
		return $this->currentOs;
	}

}