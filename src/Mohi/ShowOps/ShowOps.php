<?php

namespace Mohi\ShowOps;

use pocketmine\plugin\PluginBase;
use pocektmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmien\plugin\Plugin;

class ShowOps extends PluginBase implements Listener {
    private $m_version = 1;
    private $messages, $db;
    
    public function onEnable() {
        @mkdir( $this->getDataFolder());
        $this->initMessage();

        $this->getServer()->getPluginManager()->registerEvents( $this, $this );
        $this->registerCommand($this->get("ops.command"), $this->get("/*description*/"),$this->get("/*usage*/")); 
    }
#-----------------------------------------------------
    public function get($var) {
        if(isset ($this->messages[$this->getServer()->getLanguage()->getLang()])) {
            $lang = $this->getServer()->getLanguage()->getLang();
        } else {
            //$lang = "eng";
            $lang = "kor";
        }
        return $this->messages[lang."-".$var];
    }
    public function initMessage() {
        $this->saveResource("messages.yml", false);
        $this->messages.Update("messages.yml");
        $this->messages = (new Config( $this->getDataFolder . "messges.yml", Config::YAML ))->getAll();
    }
    public function messageUpdate($yml) {
        $target = (new Config($this->getDataFolder() . $yml, Config::YAML))->getAll();
        if (! isset( $target["m_version"])) {
            $this->saveResource($target, true);
        }else if($target["m_version"] < $this->m_version) {
            $this->saveResource($target, true);
        }
    }
#-----------------------------------------------------
    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
        switch(strtolower($command)) {
            case /*¸í·É¾î*/:
        }
    }
#-----------------------------------------------------
    public function registerCommand($name, $permission, $description = "", $usage = "") {
        $commandMap = $this-> getServer()->getCommandMap();
        $command = new PluginCommand( $name, $this );
        $command->setDescription( $description );
        $command->setPermission( $permission );
        $command->setUsage( $usage );
        $commandMap->register( $name, $command );
    }
    public function message(CommandSender $player, $text = "", $mark = null) {
        if($mark == null)
            $mark = this->get("default-prefix");
        $player->sendMessage(TextFormat::RED . $mark . "" . $text);
    }
    public function alert(CommandSender $player, $text = "", $mark = null) {
        if( $mark == null)
            $mark = $this->get("default-prefix");
        $player->sendMessage (TextFormat::RED . $mark . "" . $text);
    }
#-----------------------------------------------------
    public function onPlayerJoin(PlayerJoinEvent $event) {

    }
    public function onPlayerQuit(PlayerQuitEvent $event) {

    }
    public function onPlayerKick(PlayerKickEvent $event) {

    }
#-----------------------------------------------------

}
?>
