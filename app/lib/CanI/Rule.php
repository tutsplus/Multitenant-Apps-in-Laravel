<?php
namespace CanI;

class Rule
{
    public $action;
    public $entity;
    public $condition;

    const WILDCARD = 'all';

    public function __construct($action, $entity, $condition = null)
    {
        $this->action    = $action;
        $this->entity    = $entity;
        $this->condition = $condition;
    }

    public function isAllowed($action, $entity, $context = null)
    {
        $result = true;

        if ($this->condition) {
            $context   = $context ?: $this;
            $condition = $this->condition->bindTo($context);
            $result    = ! is_string($entity) && $condition($entity);
        }

        return $result;
    }
}
