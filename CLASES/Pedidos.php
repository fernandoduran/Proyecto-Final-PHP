<?php

	/**
	* @author Fernando Duran Ruiz
	*/
	class Pedidos
	{
		
		private $IdPedido;
		private $Login;
		private $IdBase;
		private $NumIng;
		private $Ingredientes;
		private $FechayHora;
		private $Servido;


	
	    /**
	     * Gets the value of IdPedido.
	     *
	     * @return mixed
	     */
	    public function getIdPedido()
	    {
	        return $this->IdPedido;
	    }

	    /**
	     * Sets the value of IdPedido.
	     *
	     * @param mixed $IdPedido the id pedido
	     *
	     */
	    public function _setIdPedido($IdPedido)
	    {
	        $this->IdPedido = $IdPedido;
	    }

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
	     */
	    public function _setLogin($Login)
	    {
	        $this->Login = $Login;
	    }

	    /**
	     * Gets the value of IdBase.
	     *
	     * @return mixed
	     */
	    public function getIdBase()
	    {
	        return $this->IdBase;
	    }

	    /**
	     * Sets the value of IdBase.
	     *
	     * @param mixed $IdBase the id base
	     *
	     */
	    public function _setIdBase($IdBase)
	    {
	        $this->IdBase = $IdBase;
	    }

	    /**
	     * Gets the value of NumIng.
	     *
	     * @return mixed
	     */
	    public function getNumIng()
	    {
	        return $this->NumIng;
	    }

	    /**
	     * Sets the value of NumIng.
	     *
	     * @param mixed $NumIng the num ing
	     *
	     */
	    public function _setNumIng($NumIng)
	    {
	        $this->NumIng = $NumIng;
	    }

	    /**
	     * Gets the value of Ingredientes.
	     *
	     * @return mixed
	     */
	    public function getIngredientes()
	    {
	        return $this->Ingredientes;
	    }

	    /**
	     * Sets the value of Ingredientes.
	     *
	     * @param mixed $Ingredientes the ingredientes
	     *
	     */
	    public function _setIngredientes($Ingredientes)
	    {
	        $this->Ingredientes = $Ingredientes;
	    }

	    /**
	     * Gets the value of FechayHora.
	     *
	     * @return mixed
	     */
	    public function getFechayHora()
	    {
	        return $this->FechayHora;
	    }

	    /**
	     * Sets the value of FechayHora.
	     *
	     * @param mixed $FechayHora the fechay hora
	     *
	     */
	    public function _setFechayHora($FechayHora)
	    {
	        $this->FechayHora = $FechayHora;
	    }

	    /**
	     * Gets the value of Servido.
	     *
	     * @return mixed
	     */
	    public function getServido()
	    {
	        return $this->Servido;
	    }

	    /**
	     * Sets the value of Servido.
	     *
	     * @param mixed $Servido the servido
	     *
	     */
	    public function _setServido($Servido)
	    {
	        $this->Servido = $Servido;
	    }
	}
?>