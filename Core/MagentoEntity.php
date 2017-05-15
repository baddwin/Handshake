<?php

namespace IrishTitan\Handshake\Core;

abstract class MagentoEntity
{
    /**
     * The factory instance.
     *
     * @var
     */
    protected $factory;

    /**
     * The repository instance.
     *
     * @var
     */
    protected $repository;

    /**
     * The collection instance.
     *
     * @var
     */
    protected $collection;

    /**
     * The entity instance.
     *
     * @var
     */
    protected $entity;

    /**
     * MagentoEntity constructor.
     *
     */
    public function __construct()
    {
        Handshake::start();
    }

    /**
     * Fill in the "default" entity data when creating
     * a new instance.
     *
     * @return void
     */
    abstract protected function fillDefaults();

    /**
     * Find the entity by id.
     *
     * @param $id
     * @param null $store
     * @return mixed
     */
    abstract public function find($id, $store = null);

    /**
     * Find the entity by id and throw an exception if not
     * found.
     *
     * @param $id
     * @param null $store
     * @return mixed
     */
    abstract public function findOrFail($id, $store = null);

    /**
     * Get the entity attributes as properties.
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($name === 'id') {
            return $this->entity->getData('entity_id');
        }

        return $this->entity->getData($name);
    }

    /**
     * Set the entity attributes dynamically via properties.
     *
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        return $this->entity->setData($name, $value);
    }

    /**
     * Get the entity instance.
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function get()
    {
        return $this->entity;
    }

    /**
     * Create a new instance of the entity.
     *
     * @return static
     */
    protected function instantiate()
    {
        return App::make(static::class);
    }

    /**
     * Delete the entity.
     *
     * @return void
     */
    public function delete()
    {
        $this->repository->delete($this->entity);
    }

    /**
     * Save the entity.
     *
     * @return $this
     */
    public function save()
    {
        $this->entity = $this->repository->save($this->entity);

        return $this;
    }

    /**
     * Create a new entity and save it to the database.
     *
     * @param array $attributes
     * @return Category
     */
    public function create(array $attributes)
    {
        $this->make($attributes);

        return $this->save();
    }

    /**
     * Make a new entity. Does not get saved to the database
     * right away.
     *
     * @param array $attributes
     * @return $this
     */
    public function make(array $attributes)
    {
        $this->entity = $this->factory->create();

        $this->fillDefaults();

        foreach ($attributes as $key => $attribute) {
            $this->entity->setData($key, $attribute);
        }

        return $this;
    }

}