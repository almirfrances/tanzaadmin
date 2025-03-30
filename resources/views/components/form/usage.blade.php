    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <x-form.input-text id="name" name="name" label="Name" required="true" />
        <x-form.input-email id="email" name="email" label="Email" required="true" />
        <x-form.input-password id="password" name="password" label="Password" required="true" />


        <x-form.select id="countries" name="countries[]" label="Select Countries"
            :options="['usa' => 'USA', 'uk' => 'UK', 'france' => 'France']" :value="['usa', 'france']"
            :required="true" />




        <x-form.textarea id="bio" name="bio" label="Bio" rows="4" />
        <x-form.checkbox id="terms" name="terms" label="Agree to terms" required="true" />

        <x-form.radio id="gender" name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female']"
            :value="'male'" required="true" />


        <x-form.file-upload id="profile-pic" name="profile_pic" label="Profile Picture" />

        <x-form.switch id="notifications" name="notifications" label="Enable Notifications" :checked="true"
            :required="true" />

        <x-form.date-picker id="dob" name="dob" label="Date of Birth" />
        <x-form.color-picker id="theme-color" name="theme_color" label="Theme Color" />
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
