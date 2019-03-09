<?php

namespace App\Jobs\Api;

use App\Exceptions\Api\Jobs\ArrayNotAssignableToRelation;
use App\Exceptions\Api\NotFoundException;
use App\Exceptions\Api\NotImplementedException;
use App\Exceptions\Api\ResourceObjectTypeError;
use App\Jobs\ProcessingSteps\ProcessRelations;
use App\Models\Address\Country;
use App\Models\Address\State;
use App\Models\ApiModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class RelationshipDestroyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var string
     */
    protected $relationship;
    private   $resourceData;

    /**
     * Create a new job instance.
     *
     * @param ApiModel $model
     * @param string $relationship
     * @param $resourceData
     */
    public function __construct(ApiModel $model, $relationship, $resourceData)
    {
        $this->model        = $model;
        $this->relationship = $relationship;
        $this->resourceData = $resourceData;
    }

    /**
     * Execute the job.
     *
     * @return array
     * @throws \Exception
     */
    public function handle()
    {
        return $this->process();
    }

    /**
     * @throws \Exception
     */
    public function process()
    {

        $model        = $this->model;
        $relationship = $this->relationship;
        $data         = $this->resourceData['data'];

        $relation     = $model->$relationship();
        $eloquent     = $relation->getModel();

        $response = ['data' => [] ];

        if ( is_identifier_object($data)) {
            $relationshipModel = ProcessRelations::deleteOrDissociateEloquentWithIOToRelationship($relation, $eloquent, $data);
            $response['data'] = $relationshipModel->get_identifier_object();
        } else {

            $currentData  = $relation->getResults();
            if( ! $currentData instanceof Collection ) {
                // Array given by requester, relation is NOT a list => can't assign a proper value
                throw new ArrayNotAssignableToRelation();
            }

            $response['data'] = [];

            foreach ($data as $dataItem) {
                if(is_identifier_object($dataItem)) {
                    $relationshipModel = ProcessRelations::deleteOrDissociateEloquentWithIOToRelationship($relation, $eloquent, $dataItem);
                    array_push($response['data'], $relationshipModel->get_identifier_object());
                }
            }
        }

        $model->push();

        return [
            'data' => [
                'message' => 'Successful disconnected the objects'
            ]
        ];
    }

}
