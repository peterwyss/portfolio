<script>
	import { onMount } from "svelte";

	onMount(() => {
	  console.log("the component has mounted");
	  console.log(_TOKEN);
	});
    let buttonAttr = ""; 
	var videoList = video_list;
	console.log("list " ,videoList);

	async function handleClick(e){
		console.log(e.target.index.value);
		console.log(videoList[e.target.index.value]);
		const i = e.target.index.value;
		console.log(_TOKEN)
		const response = await axios(
		{
			url: "/admin/video/store",
			method: 'POST',
			//headers: {
			//	'Accept': 'application/json',
			//	'Content-Type': 'application/json',
			//	'X-CSRF-TOKEN': _TOKEN
			//},
			params: {
				'name' : videoList[i].name,
				'video_id': videoList[i].video_id,
				'description':	videoList[i].description,
				'visible' : "false",
				'position' : 0,
				'page' : 0,
				'picture': videoList[i].pictures.sizes[0].link,
				'exist' : videoList[i].exist,
			}
		});
		//const data = await response.json();
		console.log(response.data.database_id);
		var newElement = document.createElement('p');
		let text = document.createTextNode(response.data.database_id);
		newElement.appendChild(text);
		var insertElement = document.getElementById(response.data.video_id);
		insertElement.appendChild(newElement);


	};

</script>

<main>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Example Component</div>
					<div class="card-body">
						I'm an example component.
						{#each videoList as item, i }
						<form on:submit|preventDefault={handleClick}>
						<input type="hidden" value="{i}" name="index" />
						<p>{item.name}</p>
						<img src={item.pictures.sizes[0].link} alt={item.name}/>
						<button  class="btn btn-primary" type="submit" >Import</button>	
						<div id={item.video_id}>
						{#if item.exist.length > 0}
						  {#each item.exist as itemExist}
						    <p>{itemExist.id}</p>
						  {/each}
						{/if}
						</div>
						</form>
						{/each}
					</div>
				</div>
			</div>
		</div>
	</div>
</main>