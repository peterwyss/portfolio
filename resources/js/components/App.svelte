<script>
	import { onMount } from "svelte";
	import Import from './Import.svelte';
	import Edit from './Edit.svelte';
	
    var page = "import";

	onMount(() => {

	
	  console.log("the component has mounted");
	  console.log(_TOKEN);
	});
    function setPage(p){
        page = p;
	}

</script>
<button class="btn btn-primary" on:click="{() => setPage('import')}">Import</button>

<button class="btn btn-primary"  on:click="{() => setPage('edit')}">Edit</button>

{#if page == "import"}
<Import/>
{:else if page == "edit"}
<Edit/>
{/if}