<?php

namespace JorenRothman\ACFBuilder\Fields\Relational;

use JorenRothman\ACFBuilder\Field;
use JorenRothman\ACFBuilder\Settings\Instructions;

class Relationship extends RelationalField
{
    public array $post_type = [];

    public array $taxonomy = [];

    public array $filters = [];

    public array $elements = [];

    public int $min = 0;

    public int $max = 0;

    public string $return_format = 'object';

    public int $bidirectional = 0;

    public string|array $bidirectional_target = '';

    /**
     * @var array<Field|string>
     */
    protected array $bidirectionalTargets = [];

    public function __construct(string $label, ?string $name = null, ?string $key = null)
    {
        $this->instructions = Instructions::$DEFAULT_INSTRUCTION_RELATIONSHIP;

        return parent::__construct($label, $name, $key);
    }

    public function setType(): void
    {
        $this->type = 'relationship';
    }

    /**
     * Add a post type.
     *
     * @param string $post_type,...
     * @return static
     */
    public function addPostType(string ...$post_type): static
    {
        $this->post_type = $post_type;

        return $this;
    }

    /**
     * Add a taxonomy.
     *
     * @param string $taxonomy,...
     * @return static
     */
    public function addTaxonomy(string ...$taxonomy): static
    {
        $this->taxonomy = $taxonomy;

        return $this;
    }


    /**
     * Add a filter.
     *
     * @param bool $search
     * @param bool $taxonomy
     * @param bool $post_type
     * @return static
     */
    public function addFilter(bool $search, bool $taxonomy = false, bool $postType = false): static
    {
        $search && $this->filters[] = 'search';
        $taxonomy && $this->filters[] = 'taxonomy';
        $postType && $this->filters[] = 'post_type';

        return $this;
    }

    /**
     * Add an element.
     *
     * @param 'featured_image' ...$element
     * @return static
     */
    public function addElement(string ...$element): static
    {
        $this->elements = $element;

        return $this;
    }

    /**
     * Set the minimum number of posts.
     *
     * @param int $min
     * @return static
     */
    public function setMin(int $min): static
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Set the maximum number of posts.
     *
     * @param int $max
     * @return static
     */
    public function setMax(int $max): static
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Set the return format.
     *
     * @param 'object'|'id' $return_format
     * @return static
     */
    public function setReturnFormat(string $return_format): static
    {
        $this->return_format = $return_format;

        return $this;
    }

    public function setBidirectional(bool $bidirectional): static
    {
        $this->bidirectional = (int) $bidirectional;

        return $this;
    }

    /**
     * Add a bidirectional target, a field or a field key.
     *
     * @param Field|string $field
     * @return static
     */
    public function setBidirectionalTarget(Field|string $field): static
    {
        $this->bidirectionalTargets[] = $field;

        return $this;
    }

    public function build(string $name = '', array $keys = []): array
    {
        $keys = $keys ?: $this->collectRootKeys($name);

        $data = parent::build($name, $keys);

        if ($this->bidirectionalTargets) {
            $data['bidirectional_target'] = array_map(
                fn(Field|string $target) => $target instanceof Field
                    ? $keys[spl_object_id($target)] ?? $target->getKey()
                    : $target,
                $this->bidirectionalTargets
            );
        }

        return $data;
    }

    public function setInstructions(string $value): static
    {
        $defaultInstruction = Instructions::$DEFAULT_INSTRUCTION_RELATIONSHIP;

        return parent::setInstructions(sprintf('%s %s', $value, $defaultInstruction));
    }
}
