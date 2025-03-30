<x-layouts.app>

    <x-partials.breadcrumb
    :items="[
        ['name' => 'Home', 'url' => route('admin.dashboard')],
    ]"
    style="style1"
/>
@if (Module::isEnabled('Email'))
@include('email::cron')
@endif
    <h1>Welcome to the Admin Dashboard!</h1>



    <div class="demo-inline-spacing">
        <x-partials.button type="primary" label="Primary" />
        <x-partials.button type="secondary" label="Secondary" />
        <x-partials.button type="success" label="Success" />
        <x-partials.button type="danger" label="Danger" />
        <x-partials.button type="warning" label="Warning" />
        <x-partials.button type="info" label="Info" />
        <x-partials.button type="dark" label="Dark" />
    </div>

    <div class="demo-inline-spacing">
        <x-partials.button type="primary" label="Primary" isLabelButton="true" />
        <x-partials.button type="secondary" label="Secondary" isLabelButton="true" />
        <x-partials.button type="success" label="Success" isLabelButton="true" />
        <x-partials.button type="danger" label="Danger" isLabelButton="true" />
        <x-partials.button type="warning" label="Warning" isLabelButton="true" />
        <x-partials.button type="info" label="Info" isLabelButton="true" />
        <x-partials.button type="dark" label="Dark" isLabelButton="true" />
    </div>


</x-layouts.app>
