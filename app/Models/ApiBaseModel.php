<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class ApiBaseModel extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderWithNestetRelations', function ($builder) {
            $builder->search();
            $builder->orderWithNestetRelations();
        });
    }

    public function scopeSearch($query){
        $search = request()->query('search');
        return $query->when($search, function($q) use ($search){
            $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        });
    }

    public function scopeOrderWithNestetRelations($query){
        $sortColumn = request()->query('sort');
        $sortDirection = request()->query('direction', 'asc');

        if(!$sortColumn){
            return $query;
        }

        $segments = explode('.', $sortColumn);
        $column = array_pop($segments);
    
        if (empty($segments)) {
            // No relations, simple orderBy on the column
            return $query->orderBy($column, $sortDirection);
        }
    
        $model = $query->getModel();
        $baseTable = $model->getTable();
        $currentTable = $baseTable;
    
        // Select all columns from the base table to prevent column collisions
        $query->select("{$baseTable}.*");
    
        foreach ($segments as $index => $relation) {
            if (!method_exists($model, $relation)) {
                throw new \Exception("Relation '{$relation}' does not exist on the model.");
            }
    
            $relationInstance = $model->$relation();
            $relatedModel = $relationInstance->getRelated();
            $relatedTable = $relatedModel->getTable();
            $alias = "{$relatedTable}_{$index}";
    
            // Determine the foreign and local keys based on the relation type
            if ($relationInstance instanceof \Illuminate\Database\Eloquent\Relations\BelongsTo) {
                $foreignKey = "{$currentTable}." . $relationInstance->getForeignKeyName();
                $ownerKey = "{$alias}." . $relationInstance->getOwnerKeyName();
            } else {
                $foreignKey = "{$alias}." . $relationInstance->getForeignKeyName();
                $ownerKey = "{$currentTable}." . $relationInstance->getLocalKeyName();
            }
    
            // Perform the left join
            $query->leftJoin("{$relatedTable} as {$alias}", $foreignKey, '=', $ownerKey);
    
            // Prepare for the next iteration
            $model = $relatedModel;
            $currentTable = $alias;
        }
    
        // Apply the orderBy clause using the final alias and column
        return $query->orderBy("{$currentTable}.{$column}", $sortDirection);
    }

    public function getAvailableFilters(){
        $requestedFilters = collect(json_decode(request()->query('getFilters', [])));
        $availableFilters = $requestedFilters->map(function($options, $column){
            $options->values = $this->getValues($options->type, $column);
            return $options;
        });
        return $availableFilters;
    }

    private function getValues($type, $column){
        $return = null;
        switch ($type) {
            case 'range':
                //find lowest and highest value
                $min = $this->min($column);
                $max = $this->max($column);
                $return = [
                    'min' => $min,
                    'max' => $max
                ];
                break;
            
            default:
                # code...
                break;
        }
        return $return;
    }
}
