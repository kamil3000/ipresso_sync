<?php


namespace Ipresso\Domain;


use function DI\string;

class ActivityParameter
{
    public const DICTIONARY = 'dictionary';
    public const MULTI = 'multi';
    public const STRING = 'string';
    public const BOOL = 'bool';
    public const INTEGER = 'integer';
    public const DATETIME = 'datetime';

    private string $name;
    private string $type;
    private string $key;
    private ?DictionaryCollection $dictionary;

    private $value;

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        switch ($this->type) {
            case self::DATETIME:
                if ($value instanceof \DateTime) {
                    $this->value = $value;
                    break;
                }
                throw  new Exception\ActivityParameterException('wrong value of the attribute: ' . $this->name . ' expected datetime');
                break;
            case self::INTEGER:
                if (is_integer($value)) {
                    $this->value = $value;
                    break;
                }
                throw  new Exception\ActivityParameterException('wrong value of the attribute: ' . $this->name . ' expected intiger');
                break;
            case self::BOOL:
                if (is_bool($value)) {
                    $this->value = $value;
                    break;
                }
                throw  new Exception\ActivityParameterException('wrong value of the attribute: ' . $this->name . ' expected bool');
                break;
            case self::STRING:
                if (is_string($value)) {
                    $this->value = $value;
                    break;
                }
                throw  new Exception\ActivityParameterException('wrong value of the attribute: ' . $this->name . ' expected string');
                break;
            case self::DICTIONARY:
                /** @var Dictionary $item */

                $found = false;
                foreach ($this->dictionary as $item) {
                    if ($item->getValue() === $value) {
                        $this->value = $value;
                        $found = true;
                        break;
                    }
                }
                if ($found) {
                    break;
                }
                throw  new Exception\ActivityParameterException('wrong value of the attribute: ' . $this->key . ' exprcted: (' . implode(',', $this->dictionary->__toArray()) . ')  given:' . gettype($value) . ' - ' . (string)$value);
                break;
            case  self::MULTI:
                /** @var Dictionary $item */
                $found = false;

                if (!is_array($this->value)) {
                    $this->value = [];
                }

                foreach ($this->dictionary as $item) {
                    if ($item->getValue() === $value) {
                        $this->value[] = $value;
                        $found = true;
                    }
                }

                if ($found) {
                    break;
                }
                throw  new Exception\ActivityParameterException('wrong value of the attribute: ' . $this->key . ' exprcted: (' . implode(',', $this->dictionary->__toArray()) . ')  given:' . gettype($value) . ' - ' . (string)$value);
                break;
            default:
                $this->value = $value;
                break;
        }

    }

    /**
     * @return mixed
     */
    public function getValue()
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

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }


}