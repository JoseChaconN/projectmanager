
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <!--div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div-->
        <div class="sidebar-brand-text mx-3">Project Manager</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestión
    </div>
<!-- Nav Item - Utilities Collapse Menu -->        
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProjects"
            aria-expanded="true" aria-controls="collapseProjects">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Proyectos</span>
        </a>
        <div id="collapseProjects" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar" style="visibility: inherit">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('project.create') }}">Nuevo</a>
                <a class="collapse-item" href="{{ route('project.index') }}">Listado</a>
            </div>
        </div>
    </li>
    {{--
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStage"
            aria-expanded="true" aria-controls="collapseStage">
            <i class="fas fa-project-diagram"></i>
            <span>Etapas</span>
        </a>
        <div id="collapseStage" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar" style="visibility: inherit">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('stage.create') }}">Nuevo</a>
                <a class="collapse-item" href="{{ route('stage.index') }}">Listado</a>
            </div>
        </div>
    </li>
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStep"
            aria-expanded="true" aria-controls="collapseStep">
            <i class="fas fa-tasks"></i>
            <span>Pasos</span>
        </a>
        <div id="collapseStep" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar" style="visibility: inherit">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('step.create') }}">Nueva</a>
                <a class="collapse-item" href="{{ route('step.index') }}">Listado</a>
            </div>
        </div>
    </li> 
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseActivity"
            aria-expanded="true" aria-controls="collapseActivity">
            <i class="fas fa-tasks"></i>
            <span>Actividades</span>
        </a>
        <div id="collapseActivity" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar" style="visibility: inherit">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('activity.create') }}">Nueva</a>
                <a class="collapse-item" href="{{ route('activity.index') }}">Listado</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTask"
            aria-expanded="true" aria-controls="collapseTask">
            <i class="fas fa-tasks"></i>
            <span>Tareas</span>
        </a>
        <div id="collapseTask" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar" style="visibility: inherit">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Nueva</a>
                <a class="collapse-item" href="#">Listado</a>
            </div>
        </div>
    </li>--}}
</ul>