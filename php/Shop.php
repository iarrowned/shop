<?php


class Shop
{
    protected $name;
    protected $stack = [];
    protected $total_items;
    protected $total_price;
    protected $capacity;

    public function __construct($name, $capacity)
    {
        $this->capacity = $capacity;
        $this->name = $name;
    }

    public function add(Good $good, $quantity = 1): bool
    {
        if ($quantity > 0)
        {
            $key = $good->title;
            for ($n = 0; $n < $quantity; $n++)
            {
                if ($this->total_items < $this->capacity){
                    $this->stack[$key]['price'] = $good->price;
                    $this->stack[$key]['quantity']++;
                    $this->stack[$key]['total_price'] += $good->price;
                    $this->stack[$key]['weight'] = $good->weight;
                    $this->stack[$key]['total_weight'] += $good->weight;
                    $this->total_items++;
                    $this->total_price += $good->price;
                }
                else {
                    echo "Места нет\n";
                    break;
                }
            }
            return true;
        }
        else
        {
            return false;
        }
    }
    public function remove($name, $mode = 1)
    {
        if ($mode == 1)
        {
            if ($this->stack[$name]['quantity'] > 0)
            {
                $this->stack[$name]['quantity']--;
                $this->stack[$name]['total_price'] -= $this->stack[$name]['price'];
                $this->stack[$name]['total_weight'] -= $this->stack[$name]['weight'];
                $this->total_price -= $this->stack[$name]['price'];
            }
            else
            {
                $this->total_price -= $this->stack[$name]['quantity']*$this->stack[$name]['price'];
                unset($this->stack[$name]);
            }

        }
        else if ($mode == 'all')
        {
            unset($this->stack[$name]);
        }

    }

    public function showInventory()
    {
        print_r($this->stack);
    }

    public function getTotalItems()
    {
        return $this->total_items;
    }

    public function getTotalPrice()
    {
        return $this->total_price;
    }

    public function getJSON()
    {
        return json_encode($this->stack);
    }

    public function __destruct()
    {
        $f = fopen("$this->name.inventory.log", 'w');
        fputs($f, serialize($this));
        fclose($f);
        echo "Магазин $this->name уничтожен";
    }
}