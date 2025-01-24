<?php

namespace App\Http\Controllers;

use App\Services\RpgSessionService;

class RpgSessionViewController extends Controller
{
    protected $rpgSessionService;

    public function __construct(RpgSessionService $rpgSessionService)
    {
        $this->rpgSessionService = $rpgSessionService;
    }

    public function index()
    {
        $sessions = $this->rpgSessionService->getAllSessions();

        return view('sessions.index', [
            'sessions' => $sessions,
        ]);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function edit($id)
    {
        $session = $this->rpgSessionService->getSessionById($id);

        return view('sessions.edit', [
            'session' => $session,
        ]);
    }

    public function details($id)
    {
        $session = $this->rpgSessionService->getSessionById($id);        

        return view('sessions.details', [
            'session' => $session,
        ]);
    }
}
