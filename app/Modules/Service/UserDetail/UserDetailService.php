<?php namespace App\Modules\Service\UserDetail;

use App\Modules\Models\User\User;
use App\Modules\Models\UserDetail\UserDetail;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserDetailService extends Service
{
    protected $userDetail;

    public function __construct(
        UserDetail $userDetail
    ){
        $this->userDetail = $userDetail;
    }

    /**
     * Create new User
     *
     * @param array $data
     * @return User|null
     */
    public function create(array $data)
    {
        try {
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ?  $data['availability'] : '')=='on' ? 'available' : 'not_available';
            $data['created_by']=Auth::user()->id;
            $data['date_of_birth'] = date('Y-m-d H:i:s', strtotime($data['date_of_birth']));
            $userDetail = $this->userDetail->create($data);
            return $userDetail;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Paginate all User
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;

        return $this->user->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function getAllUser()
    {
        $filter['limit'] = 25;
        return $this->user->orderBy('id', 'DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */
    public function supervisors()
    {
        return $this->user->all();
    }

    /**
     * Get a User
     *
     * @param $userId
     * @return User |null
     */
    public function find($userId)
    {
        try {
            return $this->user->find($userId);
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Update the User
     * @param $userId
     * @param array $data
     * @return bool
     */
    public function update($userDetailId, array $data)
    {
        try {
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ?  $data['availability'] : '')=='on' ? 'available' : 'not_available';
            $data['last_updated_by']=Auth::user()->id;
            $userDetail= $this->userDetail->find($userDetailId);
            $userDetail = $userDetail->update($data);
            return $userDetail;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Delete a User
     *
     * @param Id
     * @return bool
     */
    public function delete($userId)
    {
        try {
            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $data['is_deleted']='yes';
            $data['status']='in_active';
            $user= $this->user->find($userId);
            $user = $user->update($data);
            return $user;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * write brief description
     * @param $name
     * @return mixed
     */
    public function getByName($username){
        return $this->user->whereName($username);
    }

    public function getById($id){
        return $this->user->whereId($id)->first();
    }

    public function getBySlug($slug){
        return $this->user->whereSlug($slug);
    }


    public function stateUsers(){
        return $this->user->typeState()->paginate('20');
    }

    public function supervisorUsers(){
        return $this->user->whereUserType('supervisor')->get();
    }

    public function examinerUsers(){
        return $this->user->whereUserType('examiner')->get();
    }

    public function getUserRole($id){
        try{
            $user = User::with('roles')->find($id);
            $roles = $user->roles;
            return $roles;
        }catch (Exception $e){
            return false;
        }
    }

}
