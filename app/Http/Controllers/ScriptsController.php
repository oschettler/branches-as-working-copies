<?php namespace Branches\Http\Controllers;

use Branches\Http\Requests;
use Branches\Http\Controllers\Controller;

use Branches\Model\Script;
use Branches\Http\Requests\ScriptRequest;

class ScriptsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $scripts = Script::all();
        return view('scripts.index')->with('scripts', $scripts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('scripts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ScriptRequest $request)
	{
        $script = Script::create($request->only(['name', 'description', 'body']));
        $script->user_id = $request->user()->id;
        $script->save();

        return redirect('scripts')
            ->with('message', 'Successfully created script!');
	}

	/**
	 * Show the form for editing the specified resource.
	 * Script derived from "route model binding"
     * @see http://laravel.com/docs/5.0/routing#route-model-binding
     *
	 * @param  Script $script
	 * @return Response
	 */
	public function edit(Script $script)
	{
		return view('scripts.edit')
            ->with('script', $script);
	}

	/**
	 * Update the specified resource in storage.
     * Script derived from "route model binding"
     * @see http://laravel.com/docs/5.0/routing#route-model-binding
	 *
	 * @param  Script $script
	 * @return Response
	 */
	public function update(Script $script, ScriptRequest $request)
	{
        $script->fill($request->only(['name', 'description', 'body']));
        $script->save();

        return redirect('scripts')
            ->with('message', 'Successfully updated script!');
	}

	/**
	 * Remove the specified resource from storage.
     * Script derived from "route model binding"
     * @see http://laravel.com/docs/5.0/routing#route-model-binding
	 *
	 * @param  Script $script
	 * @return Response
	 */
	public function destroy(Script $script)
	{
        $script->delete();

        return redirect('scripts')
            ->with('message', 'Successfully deleted the script!');
	}

}
