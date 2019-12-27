<script>
	import { onMount } from "svelte";
	import Import from './Import.svelte';
	import Edit from './Edit.svelte';
	
	onMount(() => {
	  console.log("the component has mounted");
	  console.log(_TOKEN);
	});
    

</script>

<Import/>
<Edit/>