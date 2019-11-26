<?php

namespace Engine;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ModelCommon.
 *
 * @package Engine
 */
class ModelCommon extends Model
{
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';
    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'updated_at';
    protected $fields = [];

    /**
     * ModelCommon constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Returns true if payout suceeded, otherwise - false.
     *
     * @return boolean
     */
    public function succeeded()
    {
        return array_search($this->status ?? '', ['success', 'expect', 'need_activation']) !== false;
    }

    public function getKeyFieldName()
    {
        return $this->keyFieldName;
    }
}