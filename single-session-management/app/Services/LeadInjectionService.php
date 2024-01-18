<?php
namespace App\Services;

use App\Contracts\InjectionServiceInterface;
use App\Models\Contact;
use App\Models\Lead;
use App\Traits\HttpResponses;
use Exception;

class LeadInjectionService implements InjectionServiceInterface
{
    use HttpResponses;
    public function injectData(array $data)
    {
        try{
            $lead = Lead::create([
                'first_name' => 'John',
                'last_name' => 'Doe',
                'postal_code' => '12345',
            ]);
            // Fetch lead data based 
            $leadId = $data['lead_id']; 
            $lead = Lead::find($leadId);
            // Check if the lead exists
            if ($lead) {
                // Create a new contact using the lead data
                $contact = new Contact([
                    'first_name' => $lead->first_name,
                    'last_name' => $lead->last_name,
                    'postal_code' => $lead->postal_code
                ]);

                // Save the contact to the contacts table
                $contact->save();
                return $this->success([],'Lead data injected into contacts table', 201);
               
            } else {
                return $this->error(
                    [],
                    'No lead found',
                    500
                );
            }

        }catch(Exception $e) {
                return $this->error(
                    [],
                    $e->getMessage(),
                    500
                );
        }
    }
}
