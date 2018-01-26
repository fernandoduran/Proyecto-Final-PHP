<?php

	/**
	* @author Fernando Duran Ruiz
	*/
	class Bases
	{
		
		private $IdBase;
		private $Descripcion;
		private $Precio;


	
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
	     * Gets the value of Descripcion.
	     *
	     * @return mixed
	     */
	    public function getDescripcion()
	    {
	        return $this->Descripcion;
	    }

	    /**
	     * Sets the value of Descripcion.
	     *
	     * @param mixed $Descripcion the descripcion
	     *
	     */
	    public function _setDescripcion($Descripcion)
	    {
	        $this->Descripcion = $Descripcion;
	    }

	    /**
	     * Gets the value of Precio.
	     *
	     * @return mixed
	     */
	    public function getPrecio()
	    {
	        return $this->Precio;
	    }

	    /**
	     * Sets the value of Precio.
	     *
	     * @param mixed $Precio the precio
	     *
	     */
	    public function _setPrecio($Precio)
	    {
	        $this->Precio = $Precio;
	    }
	}
?>