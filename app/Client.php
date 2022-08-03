<?php
namespace App;

use App\Traits\FilterByUser;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Client
 *
 * @package App
 * @property string $name
 * @property string $created_by
*/
class Client extends Model implements HasMedia
{
    use SoftDeletes,InteractsWithMedia, FilterByUser;

    protected $fillable = ['kyc_form', 'enrollment_list','signed_proposal','sec_articles',
    'articles_incorp','by_laws','coc','cert_list','valid_id','statement','folder_id','created_by_id'];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id')->withTrashed();
    }
    public function setFolderIdAttribute($input)
    {
        $this->attributes['folder_id'] = $input ? $input : null;
    }
}
