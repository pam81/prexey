<?php
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class TipoCostoRepository extends EntityRepository 
{
    public function findAll() {

    $q = $this->getEntityManager()
        ->createQuery("SELECT e.id, e.code, e.texto,e.isCc
                               FROM BackendAdminBundle:TipoCosto e
                               where e.isDelete = false
                               ORDER BY e.texto ");
    return $q->getResult();

  }

}

?>