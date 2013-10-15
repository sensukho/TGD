<?php

namespace Landing\Pages\CoreBundle\Controller;

class MemCached{
    private $memcache;
    //tiempo de expiracion en segundos
    private  $expiracion = 900;
    //ruta de archivos en cache
    private $path = "/tmp/xmlcache/";

    public function __construct(){
            $this->memcache = new Memcache();
            $this->memcache->addServer('localhost', 11211);
    }

    public function existsKey($key){
        $exists = $this->memcache->get($key);
        if($exists == FALSE){
            return FALSE;
        }
        return TRUE;
    }

    public function persistObjectCache($key,$result){
        $this->memcache->set($key,$result,$this->expiracion);
    }

    public function getObjectByKey($key) {
        $value = $this->memcache->get($key);
        return $value;
    }

}