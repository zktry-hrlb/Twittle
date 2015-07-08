// Object.defineProperty が使えない環境に対応
// 引用元：http://qiita.com/alucky0707/items/79b7f625cfd95ee3755d
function extendMethod(object, methodName, method) {
	if(typeof Object.defineProperty !== 'function') {
		object[methodName] = method;
	} else {
		Object.defineProperty(object, methodName, {
			configurable: false,
			enumerable: false,
			value: method,
		});
	}
}

/**
 * オブジェクト同士を加算
 * @return Object 左辺と右辺を加算して作られた新しいオブジェクト
 */
extendMethod(Object.prototype, 'plus', function(arg){
	var ret = {};
	for(key in this){
		ret[key] = this[key];
	}
	for(key in arg){
		if(key in ret){
			if(typeof arg[key] === 'function')continue;
			ret[key] = ret[key] + arg[key];
		}
		else{
			ret[key] = arg[key];
		}
	}
	return ret;
});