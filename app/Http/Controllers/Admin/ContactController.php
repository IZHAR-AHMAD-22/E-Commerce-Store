<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.contacts.index');
    }

    public function getData()
    {
        return DataTables::of(Contact::query())
            ->addColumn('is_read', function ($contact) {
                if ($contact->is_read) {
                    return '<span style="background:#10B981;color:white;
                            padding:3px 10px;border-radius:20px;
                            font-size:12px;">Read</span>';
                }
                return '<span style="background:#EF4444;color:white;
                        padding:3px 10px;border-radius:20px;
                        font-size:12px;">Unread</span>';
            })
            ->addColumn('actions', function ($contact) {
                $viewUrl = route('admin.contacts.show', $contact->id);
                $readUrl = route('admin.contacts.read', $contact->id);
                return '
                    <a href="' . $viewUrl . '" 
                        style="background:#3B82F6;color:white;
                        padding:4px 10px;border-radius:6px;
                        text-decoration:none;font-size:13px;">
                        View
                    </a>
                    <form action="' . $readUrl . '" method="POST" 
                        style="display:inline;">
                        <input type="hidden" name="_token" 
                            value="{{ csrf_token() }}">
                        <button type="submit" 
                            style="background:#10B981;color:white;
                            padding:4px 10px;border-radius:6px;
                            border:none;font-size:13px;cursor:pointer;">
                            Mark Read
                        </button>
                    </form>';
            })
            ->rawColumns(['is_read', 'actions'])
            ->make(true);
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);
        return view('admin.contacts.show', compact('contact'));
    }

    public function markRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);
        return redirect()->back()
            ->with('success', 'Message marked as read!');
    }
}