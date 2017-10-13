<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 011 11.10.17
 * Time: 18:40
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 *
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Поле не может быть пустым!")
     * @Assert\Regex("/[А-Яа-я\-\']+/",
     *     message="Недопустимые символы"
     * )
     */
    private $first_name;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Поле не может быть пустым!")
     * @Assert\Regex("/[А-Яа-я\-\']+/",
     *     message="Недопустимые символы"
     * )
     */
    private $last_name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $gender;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Поле не может быть пустым!")
     * @Assert\Length(
     *     min="2",
     *      max="5",
     *      minMessage="Не меньше 2 символов",
     *      maxMessage="Не больше 5 символов"
     * )
     * @Assert\Regex("/^\w{2,5}/u", message="Только буквы и цифры")
     */
    private $group_number;

    /**
     * @ORM\Column(type="integer", length=8)
     * @Assert\NotBlank(message="Поле не может быть пустым!")
     * @Assert\Range(
     *     min="4",
     *     max="1000",
     *     minMessage="Слишком мало баллов"
     * )
     */
    private $total_vno_score;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\Range(
     *     min="1920",
     *     max="2004",
     *      minMessage="Не поздновато ли учится?:)",
     *      maxMessage="Вы слишком молоды для абитуриента!"
     * )
     */
    private $birth_year;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $is_resident;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return integer
     */
    public function getBirthYear()
    {
        return $this->birth_year;
    }

    /**
     * @param integer $birth_year
     */
    public function setBirthYear($birth_year)
    {
        $this->birth_year = $birth_year;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getGroupNumber()
    {
        return $this->group_number;
    }

    /**
     * @param string $group_number
     */
    public function setGroupNumber($group_number)
    {
        $this->group_number = $group_number;
    }

    /**
     * @return boolean
     */
    public function getIsResident()
    {
        return $this->is_resident;
    }

    /**
     * @param boolean $is_resident
     */
    public function setIsResident($is_resident)
    {
        $this->is_resident = $is_resident;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return integer
     */
    public function getTotalVnoScore()
    {
        return $this->total_vno_score;
    }

    /**
     * @param integer $total_vno_score
     */
    public function setTotalVnoScore($total_vno_score)
    {
        $this->total_vno_score = $total_vno_score;
    }



}