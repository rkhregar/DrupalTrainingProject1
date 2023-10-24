Exercises

Configuration Form

    Create a custom module that provides a configuration form available at the url mymodule/config to all users with the permission “administer content”
    Create fields to capture below configuration

    Country
        Default Value = India   
    City
        Default Value = Kolkata
    API Key
        Generate an API key from Weather API 
    API Endpoint
        Current weather data 

    Get the form to work such that the form values are saved and persisted on the form on reload.
    The values submitted on the form should be accessible elsewhere on the same or a different module using the Config API.

Simple Form

    In the above created module, create a simple form available at the URL mymodule/simple
    Create a custom permission called administer mymodule configuration and make sure only users who have this permission has access to mymodule/simple

    Create below fields
    Country
        Type = select list
        It should display list of all the countries

    Location

        State
            type = textfield
        City
            type = text field

    Location should be a multivalued field such that a user can add multiple city and states. Please make sure the who location is multivalued not the individual fields.

        for e.g. West Bengal, Kolkata
        for e.g. Rajasthan, Jaipur

    Add validation to make sure only user only enters alphabets in state and city fields
    Upon submitting the form, output the following


    Your selected country is  - India
    Below are the locations you have entered

        West Bengal, Kolkata
        Rajasthan, Jaipur

Form alter

    Add 2 fields to the user account - first name and last name
    In a custom module, alter the form to show a custom field full name
    On submission, the full name field should break the full name after the first word, the first word should be added to the first name field and rest into the last name field
