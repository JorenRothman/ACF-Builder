<?php

namespace JorenRothman\ACFBuilder;

use JorenRothman\ACFBuilder\Util\StringUtil;

/**
 * Class FieldGroupLocations
 *
 * @package JorenRothman\ACFBuilder
 */
class FieldGroup
{

    public string $title;

    public string $name;

    public string $key;

    public int $menu_order = 0;

    public string $position = 'normal';

    public string $style = 'default';

    public string $label_placement = 'top';

    public string $instruction_placement = 'label';

    public mixed $hide_on_screen = '';

    public bool $active = true;

    public string $description = '';

    public bool $show_in_rest = false;

    public array $fields = [];

    public array $location = [];

    /**
     * FieldGroup constructor.
     *
     * @param string $title
     * @param null|string $name
     * @param null|string $key
     * @return void
     */
    public function __construct(string $title, ?string $name = null, ?string $key = null)
    {
        $this->title = $title;
        $this->name = StringUtil::nameFormat($name ?? $title);

        $this->setKey($key ?? $this->name);
    }

    /**
     * Set key for field group.
     *
     * @param string $value
     * @return FieldGroup
     */
    protected function setKey(string $value): static
    {
        $this->key = 'group_' . $value;

        return $this;
    }

    /**
     * Set the order in which the order of a fieldgroup is determined.
     *
     * @param integer $value
     * @return FieldGroup
     */
    public function setMenuOrder(int $value): static
    {
        $this->menu_order = $value;

        return $this;
    }

    /**
     * Set the meta box position of the field group.
     *
     * @param 'normal'|'side'|'acf_after_title' $value
     * @return FieldGroup
     */
    public function setPosition(string $value): static
    {
        $this->position = $value;

        return $this;
    }

    /**
     * Set style of the field group.
     *
     * @param 'default'|'seamless' $value
     * @return FieldGroup
     */
    public function setStyle(string $value): static
    {
        $this->style = $value;

        return $this;
    }

    /**
     * Set the placement of the label.
     *
     * @param 'top'|'left' $value
     * @return FieldGroup
     */
    public function setLabelPlacement(string $value): static
    {
        $this->label_placement = $value;

        return $this;
    }

    /**
     * Set the placement of the instructions.
     *
     * @param 'label'|'field' $value
     * @return FieldGroup
     */
    public function setInstructionPlacement(string $value): static
    {
        $this->instruction_placement = $value;

        return $this;
    }

    /**
     * Set the hide on screen option.
     *
     * @param array<'permalink'|'the_content'|'excerpt'|'discussion'|'comments'|'revisions'|'slug'|'author'|'format'|'page_attributes'|'featured_image'|'categories'|'tags'|'send-trackbacks'> $value
     * @return FieldGroup
     */
    public function setHideOnScreen(array $value): static
    {
        $this->hide_on_screen = $value;

        return $this;
    }

    /**
     * Set the active state of the field group.
     *
     * @param boolean $value
     * @return FieldGroup
     */
    public function setActive(bool $value): static
    {
        $this->active = $value;

        return $this;
    }

    /**
     * Set the description of the field group.
     *
     * @param string $value
     * @return FieldGroup
     */
    public function setDescription(string $value): static
    {
        $this->description = $value;

        return $this;
    }

    /**
     * Set the show in rest option.
     *
     * @param bool $value
     * @return FieldGroup
     */
    public function setShowInRest(bool $value): static
    {
        $this->show_in_rest = $value;

        return $this;
    }

    /**
     * Set the location of the field group.
     *
     * @param FieldGroupLocations $locations
     * @return FieldGroup
     */
    public function setLocations(FieldGroupLocations $locations): static
    {
        $this->location = $locations->build();

        return $this;
    }

    /**
     * Add one or more fields to the field group.
     *
     * @param Field ...$fields
     * @return FieldGroup
     */
    public function addField(Field ...$fields): static
    {
        foreach ($fields as $field) {
            $field->onAddToFieldGroup($this);

            $this->fields[] = $field;
        }

        return $this;
    }

    /**
     * build the field group.
     *
     * @return array
     */
    public function build(): array
    {
        $keys = [];
        foreach ($this->fields as $field) {
            $keys += $field->collectKeys();
        }

        $data = json_decode(json_encode($this), true);
        $data['fields'] = array_values(array_map(
            fn(Field $field) => $field->build('', $keys),
            $this->fields
        ));

        return $data;
    }

    public function register(?FieldGroupLocations $locations = null, ?int $menuOrder = null): void
    {
        if (!function_exists('acf_add_local_field_group') || !function_exists('add_action')) {
            return;
        }

        if ($locations) {
            $this->setLocations($locations);
        }

        if ($menuOrder) {
            $this->setMenuOrder($menuOrder);
        }

        add_action('acf/init', function () {
            acf_add_local_field_group($this->build());
        });
    }
}
