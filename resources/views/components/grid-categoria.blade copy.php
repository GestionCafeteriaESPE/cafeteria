@props(['categoria'])

<div class="text-center py-12">
        <div id="{{ strtolower($categoria->nombre_cat) }}" class="font-bold" style="color: #F0B39E; font-size: 2rem;">
            {{ strtoupper($categoria->nombre_cat) }}
        </div>
    </div>