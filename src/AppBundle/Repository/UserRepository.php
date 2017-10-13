<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * Class UserRepository
 * @package AppBundle\Repository
 */
class UserRepository extends EntityRepository implements UserLoaderInterface
{
    /**
     * @param string $username
     * @return mixed
     */
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param int $page
     * @param bool $sort_asc
     * @return array
     */
    public function loadUserOrderByFirstName(int $page = 1, bool $sort_asc = true){
        $offset = ($page - 1) * 50;
        $sort = $sort_asc?'ASC':'DESC';
        $data = $this->findBy([],['first_name' => $sort], 50, $offset);
        return $this->FormatDataToArray($data);
    }

    /**
     * @param int $page
     * @param bool $sort_asc
     * @return array
     */
    public function loadUserOrderByLastName(int $page = 1, bool $sort_asc = true){
        $offset = ($page - 1) * 50;
        $sort = $sort_asc?'ASC':'DESC';
        $data = $this->findBy([],['last_name' => $sort], 50, $offset);
        return $this->FormatDataToArray($data);
    }

    /**
     * @param bool $sort_asc
     * @return array
     */
    public function loadUserOrderByScore( bool $sort_asc = true){
        $sort = $sort_asc?'ASC':'DESC';
        $data = $this->findBy([],['total_vno_score' => $sort]);
        return $this->FormatDataToArray($data);
    }

    /**
     * @param int $page
     * @param bool $sort_asc
     * @return array
     */
    public function loadUserOrderByGroup(int $page = 1, bool $sort_asc = true){
        $offset = ($page - 1) * 50;
        $sort = $sort_asc?'ASC':'DESC';
        $data = $this->findBy([],['group' => $sort], 50, $offset);
        return $this->FormatDataToArray($data);
    }

    /**
     * @param $data
     * @return array
     */
    private function FormatDataToArray($data){
        $formatted_data = [];
        foreach ($data as $value){
            $formatted_data[] = [
                'first_name' => $value->getFirstName(),
                'last_name' => $value->getLastName(),
                'group' => $value->getGroupNumber(),
                'score' => $value->getTotalVnoScore(),
            ];
        }
        return $formatted_data;
    }
}