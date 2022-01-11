var dobotUI = {
	index:0,
	setCmdTimeout:function(){
		dobot.setCmdTimeout(3000);
	},
	setEndType:function(){
		var endType = $("#endTypeSelect").val();
		dobot.SetEndEffectorParams(endType, 0, 0);
	},
	SetJOGJointParams:function(){
		dobot.SetJOGJointParams(100, 100, 100, 100, 100, 100, 100, 100, 0)
	},
	SetJOGCommonParams:function(va){
		dobot.SetJOGCommonParams(100, 100, 0)
	},
	setJogInstantCmd:function(ty, status){
		ty = status == 1 ? ty : 0;
		dobot.SetJOGCmd(0, ty, 0)
	},
	setEndEffectorGrap:function(){
		dobot.SetEndEffectorGripper(1, 1, 0);
		setTimeout(function() {
			dobot.SetEndEffectorGripper(0, 1, 0);
		}, 1000);
	},
	stopEndEffectorGrap:function(){
		dobot.SetEndEffectorGripper(1, 0, 0);
		setTimeout(function() {
			dobot.SetEndEffectorGripper(0, 1, 0);
		}, 1000);
	},
	init:function(){

	}
}