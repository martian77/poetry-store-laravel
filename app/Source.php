<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = ['id', 'link', 'description', 'sourceType',];

    public function sourceable()
    {
      return $this->morphTo();
    }

    /**
     * Updates the sources stored on a model.
     *
     * Any existing sources not in the passed array will be deleted.
     *
     * @param array|null $sources   Sources to add/update.
     * @param Model $model          Model to add sources to.
     * @throws \Exception           Exception thrown if sources invalid.
     * @return Model
     */
    public static function storeSources($sources, Model $model )
    {
        if ( empty( $sources ) ) {
            $sources = [];
        }
        if ( ! is_array($sources)) {
            throw new \Exception('Sources passed for storage invalid: ' . print_r($sources, true) );
        }
        $existingSources = $model->sources;
        if ( count($existingSources) > 0 )
        {
            foreach( $existingSources as $existing )
            {
                $id = $existing->id;
                $updated = false;
                foreach($sources as $key => $source)
                {
                    if ($id == $source['id']) {
                        if ( ! (empty($source['description']) && empty($source['link']))) {
                            $updated = true;
                            $existing->sourceType = $source['sourceType'];
                            $existing->description = $source['description'];
                            $existing->link = $source['link'];
                            $existing->save();
                        }
                        unset($sources[$key]);
                        break;
                    }
                }
                if ( ! $updated )
                {
                    $existing->delete();
                }
            }
        }
        // Now add anything that's left.
        if (count($sources) > 0 ) {
            foreach($sources as $source) {
                if ( ! (empty($source['description']) && empty($source['link']))) {
                    $model->sources()->create($source);
                }
            }
        }
        return $model;
    }
}
