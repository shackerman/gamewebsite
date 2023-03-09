<?php
class User
{
    private $_name;
    private $_phone;
    private $_email;
    private $_password;

    function __construct(){
        $this->_name = "";
        $this->_phone = "";
        $this->_email = "";
        $this->_password= "";
    }

    /**
     * @param mixed|string $phone
     */
    public function setPhone(string $phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed|string
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed|string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed|string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed|string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed|string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed|string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }
}