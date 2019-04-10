@extends('layouts.app')

@section('content')
<div class="about">
	<h1>The Delphi Process</h1>
	<br />
	<h4>1. Pick a facilitation leader. Select a person that can facilitate, is an expert in research data collection, and is not a stakeholder. An outsider is often the common choice.</h4>
	<br />
	<h4>2. Select a panel of experts. The panelists should have an intimate knowledge of the projects, or be familiar with experiential criteria that would allow them to prioritize the projects effectively. In this case, the department managers or project leaders (even though stakeholders) are appropriate.</h4>
	<br />
	<h4>3. Identify a &ldquo;straw man&rdquo; criteria list from the panel. In a brainstorming session, build a list of criteria that all think appropriate to the projects at hand. Input from non-panelists is welcome. At this point, there are no &ldquo;correct&rdquo; criteria. However, business alignment, risk, ROI, technical merit, and cost are the usual criteria; secondary criteria may be project-specific.</h4>
	<br />
	<h4>4. The panel ranks the criteria. For each criterion, the panel ranks it as 1 (very important), 2 (somewhat important), or 3 (not important). Each panelist ranks the list individually&mdash;and anonymously if the environment is charged politically or emotionally.</h4>
	<br />
	<h4>5. Calculate the mean and deviation. For each item in the list, find the mean value and remove all items with a mean greater than or equal to 2.0. Place the criteria in rank order and show the (anonymous) results to the panel. Discuss reasons and assumptions for items with high standard deviations, which indicate high levels of disagreement. The panel may insert removed items back into the list after discussion.</h4>
	<br />
	<h4>6. Re-rank the criteria. Repeat the ranking process among the panelists until the results stabilize. The ranking results do not have to have complete agreement, but a consensus such that the all can live with the outcome. Two passes are often enough, but four are frequently performed for maximum benefit. In one variation, general input is allowed after the second ranking in hopes that more information from outsiders will introduce new ideas or new criteria, or improve the list.</h4>
	<br />
	<h4>7. Identify project constraints and preferences. Projects as a whole are often constrained by total corporate budget, or mandatory requirements like regulatory impositions. These &ldquo;hard constraints&rdquo; are used to set boundaries on the project ranking. More flexible, &ldquo;soft constraints&rdquo; are introduced as preferences. Typically, hard constraints apply to all projects; preferences usually apply to only some projects. Each panelist is given a supply of preference points, about 70% of the total number of projects. (For example, give each panelist 21 preference points if 30 projects have been defined.)</h4>
	<br />
	<h4>8. Rank projects by constraint and preference. Each panelist ranks the projects first by the hard constraints. Which project is most important to that panelist? Some projects may be ignored. For example, if the total corporate budget is 100 million, the panelist allocates each project a budget, up to the maximum requested for that particular project, and such that the total of all budgets does not exceed the $100 million. Some projects may not be allocated any funding. Next, each panelist spreads his or her preference points among the project list as desired. Some projects may get ten points, others may get none, but the total may not exceed the predefined maximum (21 in the preceding example).</h4>
	<br />
	<h4>9. Analyze the results and feedback to panel. Find the median ranking for each project and distribute the projects into quartiles of 25th, 50th, and 75th percentiles (50th percentile being the median). Produce a table of ranked projects, with preference points, and show to the panel. Projects between the 25th and 75th quartile may be considered to have consensus (depending on the degree of agreement desired); projects in the outer-quartiles should be discussed. Once the reason for the large difference in ranking is announced, repeat the ranking process.</h4>
	<br />
	<h4>10. Re-rank the projects until it stabilizes. After discussing why some people (minority opinion) ranked their projects as they did, repeat the rankings. Eventually the results will stabilize after now more than four passes: projects will come to a consensus. Not everyone may be persuaded to rank the same way, but discussion is unnecessary when the opinions stay fixed. Present the ranking table to the decision makers, with the various preferences as options, for their final decision.</h4>
	<br />
	<p>Source: <i>Agile Development in the Real World</i>, By Alan Cline</p>
</div>
@endsection