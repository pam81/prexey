<?php
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class MovimientoRepository extends EntityRepository 
{
    public function getNextRecibo()
    {
        $q = $this
            ->createQueryBuilder('u')
            ->select('max(u.recibo) as maximo ')
            ->getQuery();
        

        try {
            // The Query::getSingleResult() method throws an exception
            // if there is no record matching the criteria.
            $resultado = $q->getOneOrNullResult();
           
            if ($resultado)
              $maximo=$resultado["maximo"]+1;
            else
             $maximo=1;
        } catch (NoResultException $e) {
            $maximo=0;
        }

        return $maximo;
    }
    //cuando se borra un movimiento debo actualizar todos 
    // los movimientos que le siguen 
    public function updateSaldoMovimiento($entity)
    {
    
      $id=$entity->getId();
      $deposito_id=$entity->getDeposito()->getId();
      
      $monto=$entity->getMonto();
      if ($entity->getTipo() == "i")
         $monto=-$monto;
      
      $dql="SELECT u FROM BackendAdminBundle:Movimiento u JOIN u.deposito d where u.isDelete=false
       and u.id > $id and d.id = $deposito_id";
      $query = $this->_em->createQuery($dql);
       
       $movimientos=$query->getResult();
      
        
       foreach($movimientos as $m)
       {
          $saldo=$m->getSaldoDeposito()+$monto;
      
          $m->setSaldoDeposito($saldo);
          $this->_em->persist($m);
          $this->_em->flush();
       
       }  
    
    }
    
    
  }