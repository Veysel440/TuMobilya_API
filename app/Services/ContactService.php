<?php

namespace App\Services;

use App\Models\Contact;
use App\Services\Interfaces\ContactServiceInterface;

class ContactService implements ContactServiceInterface
{
    public function getAllContacts()
    {
        return Contact::all();
    }

    public function getContactById($id)
    {
        return Contact::findOrFail($id);
    }

    public function createContact(array $data)
    {
        return Contact::create($data);
    }

    public function updateContact($id, array $data)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($data);
        return $contact;
    }

    public function deleteContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return true;
    }
}
