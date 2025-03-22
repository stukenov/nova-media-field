<?php

namespace STukenov\MediaField;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use STukenov\MediaField\Filters\Collection;

class Media extends Resource
{
    public static $model = '\STukenov\MediaField\Models\Media';
    public static $displayInNavigation = false;
    public static $search = ['collection_name', 'path', 'file_name', 'mime_type'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(),
            Image::make('Preview', 'thumbnail_path')
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->resolveUsing(function ($value, Model $resource, $attribute) {
                    $novaRequest = app()->make(NovaRequest::class);
                    if ($novaRequest->isResourceDetailRequest()) return $resource->file_path;

                    return $resource;
                }),
            Text::make('Name', 'file_name')->readonly(),
            UrlField::make('Url', 'url')->readonly(),
            Text::make('Collection', 'collection_name')->readonly(),
        ];
    }


    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Collection,
        ];
    }
}
