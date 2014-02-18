<?php

namespace Boutcaz\BoutiqueBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * GuestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GuestRepository extends EntityRepository
{
	public function findLastModifiedThing()
{
    $query = $this->createQueryBuilder('g')
        ->select('g.id')
        ->orderBy('g.id', 'desc')
        ->setMaxResults(1);
 
    $result = $query->getQuery()->getOneOrNullResult();
    
    if($result == 0 )
    {
	    $result = 1;
    }
 
    return null == $result ? null : $result['id'];
}
}
