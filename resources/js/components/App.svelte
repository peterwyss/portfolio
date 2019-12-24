<script>
	import { onMount } from "svelte";

	onMount(() => {
	  console.log("the component has mounted");
	  console.log(_TOKEN);
	});

	var videoList = video_list;
	console.log("list " ,videoList);

	async function handleClick(e){
		console.log(e.target.index.value);
		console.log(videoList[e.target.index.value]);
		const i = e.target.index.value;
		console.log(videoList[i].uri)
		const response = await fetch("/admin/video/store",
		{
			method: 'POST',
			headers: {
				'Accept': 'application/json',
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN' : _TOKEN
			},
			body: JSON.stringify({
				'name' : videoList[i].name,
				'video_id': videoList[i].video_id,
				'description':	videoList[i].description,
				'visible' : "false",
				'position' : 0,
				'page' : 0,
				'picture': videoList[i].pictures.sizes[0].link,
			})
		});
		//const data = await response.json();
		console.log(response);
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
						</form>
						{/each}
					</div>
				</div>
			</div>
		</div>
	</div>
</main>