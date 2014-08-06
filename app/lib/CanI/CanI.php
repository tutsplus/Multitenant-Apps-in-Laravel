<?php
namespace CanI;

class CanI
{
    protected $user;
    protected $rules = [];

    const WILDCARD = 'all';

    public function __construct($currentUser)
    {
        $this->user = $currentUser;
    }

    public function can($action, $entity)
    {
        return array_reduce($this->rules, function($result, $rule) use ($action, $entity) {
            if ($this->isRelevant($rule, $action, $entity)) {
                $result = $result || $rule->isAllowed($action, $entity, $this);
            }
            return $result;
        }, false);
    }

    public function cannot($action, $entity)
    {
        return ! $this->can($action, $entity);
    }

    public function allow($action, $entity, $condition = null)
    {
        $this->rules[] = new Rule($action, $entity, $condition);
    }

    public function getUser()
    {
        return $this->user;
    }

    protected function isRelevant($rule, $action, $entity)
    {
        $entityClass   = is_string($entity) ? $entity : get_class($entity);
        $matchesEntity = in_array($rule->entity, [$entityClass, static::WILDCARD]);

        return $matchesEntity && $rule->action === $action;
    }
}
