<?php

namespace Foxy\GUI;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\listener;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\item\Item;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        if(!InvMenuHandler::isRegistered()){
            InvMenuHandler::register($this);
           }  
          }

          public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args){
              switch($cmd->getName()){
                  case "gui":
                  if($sender instanceof Player){
                      $this->gui($sender);
                  }else{
                      $sender->sendMessage("console cant view guis nerd");
                  }
              }
              return true;
          }

          public function gui($sender){
              $menu = InvMenu::create(InvMenu::TYPE_CHEST);
              $menu->readonly();
              $menu->setListener([$this, "guilistener"]);
              $inv = $menu->getInventory();
              // lets set a name for the gui
              $inv->setName("GUI");
              $firstitem = Item::get(1, 0,1);
              $firstitem->setCustomName("This is a custom name");
              $inv->setItem(1, $firstitem);
              $inv->send($sender);
          }


        // lets create the listener function
        public function guilistener(Player $sender, Item $item){
        if($item->getId() == 2 && $item->getDamage() == 0){
            $sender->sendMessage("hello there!");
            $sender->removeWindow($inv);
          }
        }



        // and
        // Vo`ila, your first gui plugin is ready!!
        // but you still need a virion 
        // to get it check the description
        // you also need a plugin called DEVirion 
        // ill provide a link to everything in description!!
        // make sure to like and subscribe!
}
