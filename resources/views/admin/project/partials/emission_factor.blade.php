<div class="row" style="margin-top: 50px">
    <h3>Emissions Factor</h3>
    <emission-factor-table
            project-id="{{ $project->id }}"
            token="{{ csrf_token() }}"
            form-action="{!! route('emission_factor.post') !!}"
    >
    </emission-factor-table>

    <emission-factor-table
            project-id="{{ $project->id }}"
            token="{{ csrf_token() }}"
            form-action="{!! route('emission_factor.post') !!}"
            sub-row-name="Vehicle"
            :type="2"
    >
    </emission-factor-table>

    <emission-factor-table
            project-id="{{ $project->id }}"
            token="{{ csrf_token() }}"
            form-action="{!! route('emission_factor.post') !!}"
            sub-row-name="Transportation"
            :type="3"
    >
    </emission-factor-table>

    <emission-factor-table
            project-id="{{ $project->id }}"
            token="{{ csrf_token() }}"
            form-action="{!! route('emission_factor.post') !!}"
            sub-row-name="Machineries & Equipment"
            :type="4"
    >
    </emission-factor-table>
    <emission-factor-table
            project-id="{{ $project->id }}"
            token="{{ csrf_token() }}"
            form-action="{!! route('emission_factor.post') !!}"
            sub-row-name="Production / Raw Material"
            :type="5"
    >
    </emission-factor-table>
</div>
<div class="row">
    <h3>Conversion Factor</h3>
    <emission-factor-table
            header-title="Conversion Factor"
            project-id="{{ $project->id }}"
            token="{{ csrf_token() }}"
            form-action="{!! route('emission_factor.post') !!}"
            sub-row-name="Transportation"
            first-column-name="Transportation"
            second-column-name="Converter Factor"
            :type="6"
    >
    </emission-factor-table>    
</div>
<div class="row">
    <h3>Material Density</h3>
    <emission-factor-table
            header-title="Material Density"
            project-id="{{ $project->id }}"
            token="{{ csrf_token() }}"
            form-action="{!! route('emission_factor.post') !!}"
            sub-row-name="Material"
            first-column-name="Material"
            second-column-name="Density"
            :type="7"
    >
    </emission-factor-table>
</div>