<?php namespace App\Modules\Service\User;

use App\Modules\Models\Role\Role;
use App\Modules\Models\User\User;
use App\Modules\Service\Role\RoleService;
use App\Modules\Service\Service;
use App\Modules\Service\UserRole\UserRoleService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserService extends Service
{
    protected $user;
    protected  $roleUser;
    protected  $role;
    public function __construct(
        User $user,
        UserRoleService $userRoleService,
        Role $role
    ){
        $this->user = $user;
        $this->role = $role;
        $this->roleUser = $userRoleService;
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
            $data['password'] = bcrypt($data['password']);
            $data['last_logged_in'] = Carbon::now();
            if(isset($data['status']))
                $data['status'] = $data['status'] == 'on' ? 'active' : 'in_active';
            else
                $data['status']='in_active';
            $user = $this->user->create($data);
            return $user;
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

    public function getCandidate($data)
    {
        $user = $this->user->find($data);
        $candidate = $user->candidate()->first();

        return $candidate;
    }


    public function getCompany($data)
    {
        $user = $this->user->find($data);

        $company = $user->company()->first();

        return $company;
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

    public function getspecificUser($val)
    {
        $users = $this->user
            ->where('email', 'like', $val.'%')
            ->inRandomOrder()
            ->limit(25)
            ->get();
        return $users;
    }



    public function getAllData()
    {
        $query = User::where('is_deleted','=', 'no');
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('image', function(User $user) {
                return getTableHtml($user,'image');
            })
            ->editColumn('roles', function(User $user) {
                return getTableHtml($user,'roles');
            })
            ->editColumn('actions', function(User $user) {
                $editRoute = route('user.edit',[$user->id]);
                $deleteRoute = route('user.delete',[$user->id]);
                $uploadRoute = false;
                $optionRoute = route('user.role',$user->id);
                $optionRouteText = 'Manage Role';

                return getTableHtml($user,'actions',$editRoute,$deleteRoute,$optionRoute,$optionRouteText,$uploadRoute);
            })->rawColumns(['image', 'roles','actions'])
            ->order(function ($query) {

                $query->orderBy('id', 'desc');
            })
            ->make(true);
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
    public function update($id, array $data)
    {
//        dd($id, $data);
        try {
            $user= $this->find($id);
            if(isset($data['status']))
                $data['status'] = $data['status'] == 'on' ? 'active' : 'in_active';
            else
                $data['status']='in_active';
            $data['last_updated_by']=Auth::user()->id;
            $user = $user->update($data);
            return $user;
        } catch (Exception $e) {
            return false;
        }
    }
    /**
     * Update the User
     * @param $userId
     * @param array $data
     * @return bool
     */
    public function updatePassword($id, array $data)
    {
        try {
            $user= $this->find($id);
            $data['last_updated_by']=Auth::user()->id;
            $user = $user->update($data);
            return $user;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Update the User
     * @param $userId
     * @param array $data
     * @return bool
     */
    public function updateUserPassword($id, array $data)
    {
        try {
            $user= $this->find($id);
            $data['last_updated_by']=Auth::user()->id;

            $user = $user->update($data);
            return $user;
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
    public function delete($id)
    {
        try {
            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $data['is_deleted']='yes';
            $data['status']='in_active';
            $user= $this->find($id);
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

    public function getByEmail($email){
        return $this->user->whereEmail($email)->first();
    }

    public function getById($id){
        return $this->user->whereId($id)->first();
    }

    public function getBySlug($slug){
        return $this->user->whereSlug($slug)->first();
    }


    public function stateUsers(){
        return $this->user->typeState()->paginate('20');
    }

    public function companyUsers(){
        $users = $this->user->whereHas('roles', function($q)
        {
            $q->where('display_name','like', '%company%');
        })->get();

        return $users;
    }

    public function candidateUsers(){
        $users = $this->user->whereHas('roles', function($q)
        {
            $q->where('display_name','like', '%candidate%');
        })->get();

        return $users;
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

    public function getUserByRole($role)
    {
        try{
            $user = User::with('roles')->find($role);
//            $roles = $user->roles;
            return $user;
        }catch (Exception $e){
            return false;
        }
    }

    function uploadFile($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/user';
            return $fileName = $this->uploadFromAjax($file);
        }
    }

    public function __deleteImages($user){
        try{
            if(is_file($user->avatar_path))
                unlink($user->avatar_path);

            if(is_file($user->thumbnail_path))
                unlink($user->thumbnail_path);
        }catch (\Exception $e){

        }
    }

    public function updateImage($userId, array $data)
    {
        try {

            $user= $this->user->find($userId);
            $user= $user->update($data);

            return $user;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    public function attachRegisterRole($user,$role)
    {
        $role = $this->role->where('display_name','like','%'.$role.'%')->first();
        return $user->attachRole($role);
    }
}
