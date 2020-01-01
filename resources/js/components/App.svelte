<script>
	import { onMount } from "svelte";
	import Import from './Import.svelte';
	import Edit from './Edit.svelte';
	
    var page = "";

	onMount(() => {

	
	  console.log("the component has mounted");
	  console.log(_TOKEN);
	});
    function setPage(p){
        page = p;
	}

</script>
<button on:click="{() => setPage('import')}">Import</button>

<button on:click="{() => setPage('edit')}">Edit</button>

{#if page == "import"}
<Import/>
{:else if page == "edit"}
<Edit/>
{/if}