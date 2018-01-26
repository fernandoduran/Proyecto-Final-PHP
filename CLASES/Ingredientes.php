<?php

	/**
	* @author Fernando Duran Ruiz
	*/
	class Ingredientes
	{
		
		private $NombreIng;
		private $Descripcion;


	
	    /**
	     * Gets the value of NombreIng.
	     *
	     * @return mixed
	     */
	    public function getNombreIng()
	    {
	        return $this->NombreIng;
	    }

	    /**
	     * Sets the value of NombreIng.
	     *
	     * @param mixed $NombreIng the nombre ing
	     *
	     */
	    public function _setNombreIng($NombreIng)
	    {
	        $this->NombreIng = $NombreIng;
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
	}
?>