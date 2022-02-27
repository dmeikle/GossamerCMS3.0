<?php

namespace Components\Dashboard\DTOs;

use Gossamer\Core\DTOs\AbstractDTO;
use Gossamer\Core\DTOs\DTOInterface;

class SettingDTO extends AbstractDTO implements DTOInterface
{
    /**
     * @var string
     */
    private  $id;

    private string $setting_groups_id;

    private string $name;

    private string $description;

    private string $priority;

    private bool $is_active;

    private string $value;

    private string $key;

    /**
     * @param  string|null  $id
     * @param  string       $setting_groups_id
     * @param  string       $name
     * @param  string       $description
     * @param  string       $priority
     * @param  bool       $is_active
     * @param  string       $value
     * @param  string       $key
     */
    public function __construct(
        string $id = null,
        string $setting_groups_id,
        string $name,
        string $description,
        string $priority,
        bool $is_active,
        string $value,
        string $key
    ) {
        $this->id = $id;
        $this->setting_groups_id = $setting_groups_id;
        $this->name = $name;
        $this->description = $description;
        $this->priority = $priority;
        $this->is_active = $is_active;
        $this->value = $value;
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getSettingGroupsId(): string
    {
        return $this->setting_groups_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getPriority(): string
    {
        return $this->priority;
    }

    /**
     * @return bool
     */
    public function getIsActive(): string
    {
        return $this->is_active;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

}
