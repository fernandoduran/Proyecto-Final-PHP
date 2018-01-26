<?php

	/**
	* @author Fernando Duran Ruiz
	* 
	*/
	class Usuarios
	{
		
		private $Login;
        private $Password;
        private $Nombre;
        private $Email;
        private $Firma;
        private $Avatar;
        private $Tipo;


	
    /**
     * Gets the value of Login.
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->Login;
    }

    /**
     * Sets the value of Login.
     *
     * @param mixed $Login the login
     *
     * @return self
     */
    public function _setLogin($Login)
    {
        $this->Login = $Login;

    }

    /**
     * Gets the value of Password.
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * Sets the value of Password.
     *
     * @param mixed $Password the password
     *
     * @return self
     */
    public function _setPassword($Password)
    {
        $this->Password = $Password;

    }

    /**
     * Gets the value of Nombre.
     *
     * @return mixed
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * Sets the value of Nombre.
     *
     * @param mixed $Nombre the nombre
     *
     * @return self
     */
    public function _setNombre($Nombre)
    {
        $this->Nombre = $Nombre;

    }

    /**
     * Gets the value of Email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * Sets the value of Email.
     *
     * @param mixed $Email the email
     *
     * @return self
     */
    public function _setEmail($Email)
    {
        $this->Email = $Email;

    }

    /**
     * Gets the value of Firma.
     *
     * @return mixed
     */
    public function getFirma()
    {
        return $this->Firma;
    }

    /**
     * Sets the value of Firma.
     *
     * @param mixed $Firma the firma
     *
     * @return self
     */
    public function _setFirma($Firma)
    {
        $this->Firma = $Firma;

    }

    /**
     * Gets the value of Avatar.
     *
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->Avatar;
    }

    /**
     * Sets the value of Avatar.
     *
     * @param mixed $Avatar the avatar
     *
     * @return self
     */
    public function _setAvatar($Avatar)
    {
        $this->Avatar = $Avatar;

    }

    /**
     * Gets the value of Tipo.
     *
     * @return mixed
     */
    public function getTipo()
    {
        return $this->Tipo;
    }

    /**
     * Sets the value of Tipo.
     *
     * @param mixed $Tipo the tipo
     *
     * @return self
     */
    public function _setTipo($Tipo)
    {
        $this->Tipo = $Tipo;

    }
}

?>