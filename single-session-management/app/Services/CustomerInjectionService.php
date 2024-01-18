<?php
namespace App\Services;

use App\Contracts\InjectionServiceInterface;
use App\Models\Contact;
use App\Models\Customer;
use App\Traits\HttpResponses;
use Exception;

class CustomerInjectionService implements InjectionServiceInterface
{
    use HttpResponses;
    public function injectData(array $data)
    {
        try{
            // Fetch customer 
            $customerId = $data['customer_id']; 
            $customer = Customer::find($customerId);

            // Check if the customer exists
            if ($customer) {
                // Create a new contact using the customer data
                $contact = new Contact([
                    'first_name' => $customer->first_name,
                    'last_name' => $customer->last_name,
                    'postal_code' => $customer->postal_code,
                    'city' => $customer->city,
                    'street_name' => $customer->street_name,
                ]);

                // Save the contact to the contacts table
                $contact->save();
                return $this->success([],'Customer data injected into contacts table', 201);
                        
            } else {
                return $this->error(
                    [],
                    'No ustomer found',
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

