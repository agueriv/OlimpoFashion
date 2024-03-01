<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioCreateRequest;
use App\Http\Requests\UsuarioEditRequest;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    const RPP = 3;
    const ORDERBY = 'users.id';
    const ORDERTYPE = 'asc';
    const PARAMS = [
        'rpp' => [
            self::RPP => self::RPP,
            6 => 0,
            12 => 0,
            24 => 0,
            36 => 0
        ],
        'orderBy' => [
            self::ORDERBY => self::ORDERBY,
            'users.name' => 0,
            'users.email' => 0,
            'users.puesto' => 0,
        ],
        'orderType' => [
            self::ORDERTYPE => self::ORDERTYPE,
            'desc' => 0
        ]
    ];

    function __construct()
    {
        $this->middleware('auth');
        // Middleware solo jefe
        $this->middleware('jefe');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rpp = self::getFromRequest($request, 'rpp', self::RPP);
        $orderBy = self::getFromRequest($request, 'orderBy', self::ORDERBY);
        $orderType = self::getFromRequest($request, 'orderType', self::ORDERTYPE);
        $q = $request->q;


        $usersQ = DB::table('users')
        ->select(
            'users.id AS id',
            'users.name AS name',
            'users.email AS email',
            'users.puesto AS puesto',
        );

        // Comprobamos la query (q)
        if ($q != null) {
            $usersQ = $usersQ->where('users.id', 'like', '%' . $q . '%')
                ->orWhere('users.name', 'like', '%' . $q . '%')
                ->orWhere('users.email', 'like', '%' . $q . '%')
                ->orWhere('users.puesto', 'like', '%' . $q . '%');
        }

        $users = $usersQ->orderBy($orderBy, $orderType)
            ->orderBy(self::ORDERBY, self::ORDERTYPE)
            ->paginate($rpp);

        $order = $orderBy . '.' . $orderType;
        $puestos = ['jefe' => 'Jefe', 'empleado' => 'Empleado'];

        return view('almacen.admin.index', [
            'users' => $users,
            'orderBy' => $orderBy,
            'orderType' => $orderType,
            'q' => $q,
            'rpps' => self::getRpp(),
            'rpp' => $rpp,
            'order' => $order,
            'puestos' => $puestos
        ]);
    }

    private static function getRpp()
    {
        return [
            3 => 3,
            6 => 6,
            12 => 12,
            24 => 24,
            36 => 36,
        ];
    }

    private static function getFromRequest($request, $name, $defaultValue)
    {
        $value = array_key_first(self::PARAMS[$name]);
        if ($request->$name != null) {
            $value = $request->$name;
        }
        if (!isset(self::PARAMS[$name][$value])) {
            $value = array_key_first(self::PARAMS[$name]);
        }
        return $value;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $puestos = ['jefe' => 'Jefe', 'empleado' => 'Empleado'];
        return view('almacen.admin.create', ['puestos' => $puestos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioCreateRequest $request)
    {
        $user = new User($request->all());
        $user->password = Hash::make($request->password);
        $user->email_verified_at = Carbon::now();
        try {
            $result = $user->save();
            // Donde redirigirá después de crear
            $target = 'almacen/admin';
            return redirect($target)->with(['message' => 'Usuario creado correctamente.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El usuario no ha sido creado correctamente.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $puestos = ['jefe' => 'Jefe', 'empleado' => 'Empleado'];
        return view('almacen.admin.show', [
            'user' => User::find($id),
            'puestos' => $puestos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $puestos = ['jefe' => 'Jefe', 'empleado' => 'Empleado'];
        return view('almacen.admin.edit', [
            'user' => User::find($id),
            'puestos' => $puestos
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioEditRequest $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->puesto = $request->puesto;
        if($request->password != '' && $request->password != null) {
            $user->password = Hash::make($request->password);
        }

        try {
            $result = $user->save();
            // Donde redirigirá después de crear
            $target = 'almacen/admin';
            return redirect($target)->with(['message' => 'Usuario editado correctamente.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El usuario no ha sido editado correctamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return redirect('almacen/admin')->with(['message' => 'Usuario eliminado con éxito.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'No se ha podido eliminar el usuario.']);
        }
    }
}
