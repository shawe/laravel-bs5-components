<?php

namespace Laravel\Bootstrap\Components\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

trait WithModel
{
    public array $model = [];
    private ?Collection $modelCollection;

    public function model(): Collection
    {
        if ($this->modelCollection === null) {
            $this->modelCollection = collect($this->model);
        }

        return $this->modelCollection;
    }

    public function setModel($key, $value = null): void
    {
        if ($key instanceof Model) {
            $key = $key->toArray();
        }

        if (is_array($key)) {
            foreach ($key as $arrayKey => $arrayValue) {
                Arr::set($this->model, $arrayKey, $arrayValue);
            }
        } else {
            Arr::set($this->model, $key, $value);
        }
    }

    public function getModel($key): mixed
    {
        return Arr::get($this->model, $key);
    }

    public function hasModel($key): bool
    {
        return Arr::has($this->model, $key);
    }

    public function addModelItem($key): void
    {
        $array = $this->getModel($key);
        $arrayKey = $array ? max(array_keys($array)) + 1 : 0;

        Arr::set($this->model, $key . '.' . $arrayKey, null);

        $this->rekeyModelItems($key);
    }

    public function removeModelItem($key, $arrayKey): void
    {
        Arr::forget($this->model, $key . '.' . $arrayKey);

        $this->rekeyModelItems($key);
    }

    public function rekeyModelItems($key): void
    {
        $this->setModel($key, array_values($this->getModel($key)));
    }

    public function orderModelItem($key, $arrayKey, $direction): void
    {
        $arrayValue = $this->getModel($key . '.' . $arrayKey);
        $swapKey = strtolower($direction) === 'up' ? $arrayKey - 1 : $arrayKey + 1;

        if ($swapValue = $this->getModel($key . '.' . $swapKey)) {
            $this->setModel($key . '.' . $arrayKey, $swapValue);
            $this->setModel($key . '.' . $swapKey, $arrayValue);
        }
    }

    public function validateModel($rules = null): array
    {
        $validator = Validator::make($this->model, $rules ?? $this->getRules());
        $validatedModel = $validator->validate();

        $this->resetErrorBag();

        return $validatedModel;
    }

    public function updatingModelSearch(): void
    {
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }
}
