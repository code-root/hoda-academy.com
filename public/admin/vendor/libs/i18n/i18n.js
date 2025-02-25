! function(t, e) {
  if ("object" == typeof exports && "object" == typeof module) module.exports = e();
  else if ("function" == typeof define && define.amd) define([], e);
  else {
    var o = e();
    for (var n in o)("object" == typeof exports ? exports : t)[n] = o[n]
  }
}(self, (function() {
  return function() {
    var t, e, o = {
        4098: function(t, e, o) {
          var n = "undefined" != typeof globalThis && globalThis || "undefined" != typeof self && self || void 0 !== o.g && o.g,
            i = function() {
              function t() {
                this.fetch = !1, this.DOMException = n.DOMException
              }
              return t.prototype = n, new t
            }();
          ! function(t) {
            ! function(e) {
              var o = void 0 !== t && t || "undefined" != typeof self && self || void 0 !== o && o,
                n = "URLSearchParams" in o,
                i = "Symbol" in o && "iterator" in Symbol,
                r = "FileReader" in o && "Blob" in o && function() {
                  try {
                    return new Blob, !0
                  } catch (t) {
                    return !1
                  }
                }(),
                s = "FormData" in o,
                a = "ArrayBuffer" in o;
              if (a) var l = ["[object Int8Array]", "[object Uint8Array]", "[object Uint8ClampedArray]", "[object Int16Array]", "[object Uint16Array]", "[object Int32Array]", "[object Uint32Array]", "[object Float32Array]", "[object Float64Array]"],
                u = ArrayBuffer.isView || function(t) {
                  return t && l.indexOf(Object.prototype.toString.call(t)) > -1
                };

              function c(t) {
                if ("string" != typeof t && (t = String(t)), /[^a-z0-9\-#$%&'*+.^_`|~!]/i.test(t) || "" === t) throw new TypeError('Invalid character in header field name: "' + t + '"');
                return t.toLowerCase()
              }

              function h(t) {
                return "string" != typeof t && (t = String(t)), t
              }

              function p(t) {
                var e = {
                  next: function() {
                    var e = t.shift();
                    return {
                      done: void 0 === e,
                      value: e
                    }
                  }
                };
                return i && (e[Symbol.iterator] = function() {
                  return e
                }), e
              }

              function f(t) {
                this.map = {}, t instanceof f ? t.forEach((function(t, e) {
                  this.append(e, t)
                }), this) : Array.isArray(t) ? t.forEach((function(t) {
                  this.append(t[0], t[1])
                }), this) : t && Object.getOwnPropertyNames(t).forEach((function(e) {
                  this.append(e, t[e])
                }), this)
              }

              function d(t) {
                if (t.bodyUsed) return Promise.reject(new TypeError("Already read"));
                t.bodyUsed = !0
              }

              function g(t) {
                return new Promise((function(e, o) {
                  t.onload = function() {
                    e(t.result)
                  }, t.onerror = function() {
                    o(t.error)
                  }
                }))
              }

              function y(t) {
                var e = new FileReader,
                  o = g(e);
                return e.readAsArrayBuffer(t), o
              }

              function m(t) {
                if (t.slice) return t.slice(0);
                var e = new Uint8Array(t.byteLength);
                return e.set(new Uint8Array(t)), e.buffer
              }

              function v() {
                return this.bodyUsed = !1, this._initBody = function(t) {
                  var e;
                  this.bodyUsed = this.bodyUsed, this._bodyInit = t, t ? "string" == typeof t ? this._bodyText = t : r && Blob.prototype.isPrototypeOf(t) ? this._bodyBlob = t : s && FormData.prototype.isPrototypeOf(t) ? this._bodyFormData = t : n && URLSearchParams.prototype.isPrototypeOf(t) ? this._bodyText = t.toString() : a && r && (e = t) && DataView.prototype.isPrototypeOf(e) ? (this._bodyArrayBuffer = m(t.buffer), this._bodyInit = new Blob([this._bodyArrayBuffer])) : a && (ArrayBuffer.prototype.isPrototypeOf(t) || u(t)) ? this._bodyArrayBuffer = m(t) : this._bodyText = t = Object.prototype.toString.call(t) : this._bodyText = "", this.headers.get("content-type") || ("string" == typeof t ? this.headers.set("content-type", "text/plain;charset=UTF-8") : this._bodyBlob && this._bodyBlob.type ? this.headers.set("content-type", this._bodyBlob.type) : n && URLSearchParams.prototype.isPrototypeOf(t) && this.headers.set("content-type", "application/x-www-form-urlencoded;charset=UTF-8"))
                }, r && (this.blob = function() {
                  var t = d(this);
                  if (t) return t;
                  if (this._bodyBlob) return Promise.resolve(this._bodyBlob);
                  if (this._bodyArrayBuffer) return Promise.resolve(new Blob([this._bodyArrayBuffer]));
                  if (this._bodyFormData) throw new Error("could not read FormData body as blob");
                  return Promise.resolve(new Blob([this._bodyText]))
                }, this.arrayBuffer = function() {
                  return this._bodyArrayBuffer ? d(this) || (ArrayBuffer.isView(this._bodyArrayBuffer) ? Promise.resolve(this._bodyArrayBuffer.buffer.slice(this._bodyArrayBuffer.byteOffset, this._bodyArrayBuffer.byteOffset + this._bodyArrayBuffer.byteLength)) : Promise.resolve(this._bodyArrayBuffer)) : this.blob().then(y)
                }), this.text = function() {
                  var t, e, o, n = d(this);
                  if (n) return n;
                  if (this._bodyBlob) return t = this._bodyBlob, o = g(e = new FileReader), e.readAsText(t), o;
                  if (this._bodyArrayBuffer) return Promise.resolve(function(t) {
                    for (var e = new Uint8Array(t), o = new Array(e.length), n = 0; n < e.length; n++) o[n] = String.fromCharCode(e[n]);
                    return o.join("")
                  }(this._bodyArrayBuffer));
                  if (this._bodyFormData) throw new Error("could not read FormData body as text");
                  return Promise.resolve(this._bodyText)
                }, s && (this.formData = function() {
                  return this.text().then(x)
                }), this.json = function() {
                  return this.text().then(JSON.parse)
                }, this
              }
              f.prototype.append = function(t, e) {
                t = c(t), e = h(e);
                var o = this.map[t];
                this.map[t] = o ? o + ", " + e : e
              }, f.prototype.delete = function(t) {
                delete this.map[c(t)]
              }, f.prototype.get = function(t) {
                return t = c(t), this.has(t) ? this.map[t] : null
              }, f.prototype.has = function(t) {
                return this.map.hasOwnProperty(c(t))
              }, f.prototype.set = function(t, e) {
                this.map[c(t)] = h(e)
              }, f.prototype.forEach = function(t, e) {
                for (var o in this.map) this.map.hasOwnProperty(o) && t.call(e, this.map[o], o, this)
              }, f.prototype.keys = function() {
                var t = [];
                return this.forEach((function(e, o) {
                  t.push(o)
                })), p(t)
              }, f.prototype.values = function() {
                var t = [];
                return this.forEach((function(e) {
                  t.push(e)
                })), p(t)
              }, f.prototype.entries = function() {
                var t = [];
                return this.forEach((function(e, o) {
                  t.push([o, e])
                })), p(t)
              }, i && (f.prototype[Symbol.iterator] = f.prototype.entries);
              var b = ["DELETE", "GET", "HEAD", "OPTIONS", "POST", "PUT"];

              function w(t, e) {
                if (!(this instanceof w)) throw new TypeError('Please use the "new" operator, this DOM object constructor cannot be called as a function.');
                var o, n, i = (e = e || {}).body;
                if (t instanceof w) {
                  if (t.bodyUsed) throw new TypeError("Already read");
                  this.url = t.url, this.credentials = t.credentials, e.headers || (this.headers = new f(t.headers)), this.method = t.method, this.mode = t.mode, this.signal = t.signal, i || null == t._bodyInit || (i = t._bodyInit, t.bodyUsed = !0)
                } else this.url = String(t);
                if (this.credentials = e.credentials || this.credentials || "same-origin", !e.headers && this.headers || (this.headers = new f(e.headers)), this.method = (n = (o = e.method || this.method || "GET").toUpperCase(), b.indexOf(n) > -1 ? n : o), this.mode = e.mode || this.mode || null, this.signal = e.signal || this.signal, this.referrer = null, ("GET" === this.method || "HEAD" === this.method) && i) throw new TypeError("Body not allowed for GET or HEAD requests");
                if (this._initBody(i), !("GET" !== this.method && "HEAD" !== this.method || "no-store" !== e.cache && "no-cache" !== e.cache)) {
                  var r = /([?&])_=[^&]*/;
                  r.test(this.url) ? this.url = this.url.replace(r, "$1_=" + (new Date).getTime()) : this.url += (/\?/.test(this.url) ? "&" : "?") + "_=" + (new Date).getTime()
                }
              }

              function x(t) {
                var e = new FormData;
                return t.trim().split("&").forEach((function(t) {
                  if (t) {
                    var o = t.split("="),
                      n = o.shift().replace(/\+/g, " "),
                      i = o.join("=").replace(/\+/g, " ");
                    e.append(decodeURIComponent(n), decodeURIComponent(i))
                  }
                })), e
              }

              function S(t, e) {
                if (!(this instanceof S)) throw new TypeError('Please use the "new" operator, this DOM object constructor cannot be called as a function.');
                e || (e = {}), this.type = "default", this.status = void 0 === e.status ? 200 : e.status, this.ok = this.status >= 200 && this.status < 300, this.statusText = void 0 === e.statusText ? "" : "" + e.statusText, this.headers = new f(e.headers), this.url = e.url || "", this._initBody(t)
              }
              w.prototype.clone = function() {
                return new w(this, {
                  body: this._bodyInit
                })
              }, v.call(w.prototype), v.call(S.prototype), S.prototype.clone = function() {
                return new S(this._bodyInit, {
                  status: this.status,
                  statusText: this.statusText,
                  headers: new f(this.headers),
                  url: this.url
                })
              }, S.error = function() {
                var t = new S(null, {
                  status: 0,
                  statusText: ""
                });
                return t.type = "error", t
              };
              var k = [301, 302, 303, 307, 308];
              S.redirect = function(t, e) {
                if (-1 === k.indexOf(e)) throw new RangeError("Invalid status code");
                return new S(null, {
                  status: e,
                  headers: {
                    location: t
                  }
                })
              }, e.DOMException = o.DOMException;
              try {
                new e.DOMException
              } catch (t) {
                e.DOMException = function(t, e) {
                  this.message = t, this.name = e;
                  var o = Error(t);
                  this.stack = o.stack
                }, e.DOMException.prototype = Object.create(Error.prototype), e.DOMException.prototype.constructor = e.DOMException
              }

              function O(t, n) {
                return new Promise((function(i, s) {
                  var l = new w(t, n);
                  if (l.signal && l.signal.aborted) return s(new e.DOMException("Aborted", "AbortError"));
                  var u = new XMLHttpRequest;

                  function c() {
                    u.abort()
                  }
                  u.onload = function() {
                    var t, e, o = {
                      status: u.status,
                      statusText: u.statusText,
                      headers: (t = u.getAllResponseHeaders() || "", e = new f, t.replace(/\r?\n[\t ]+/g, " ").split("\r").map((function(t) {
                        return 0 === t.indexOf("\n") ? t.substr(1, t.length) : t
                      })).forEach((function(t) {
                        var o = t.split(":"),
                          n = o.shift().trim();
                        if (n) {
                          var i = o.join(":").trim();
                          e.append(n, i)
                        }
                      })), e)
                    };
                    o.url = "responseURL" in u ? u.responseURL : o.headers.get("X-Request-URL");
                    var n = "response" in u ? u.response : u.responseText;
                    setTimeout((function() {
                      i(new S(n, o))
                    }), 0)
                  }, u.onerror = function() {
                    setTimeout((function() {
                      s(new TypeError("Network request failed"))
                    }), 0)
                  }, u.ontimeout = function() {
                    setTimeout((function() {
                      s(new TypeError("Network request failed"))
                    }), 0)
                  }, u.onabort = function() {
                    setTimeout((function() {
                      s(new e.DOMException("Aborted", "AbortError"))
                    }), 0)
                  }, u.open(l.method, function(t) {
                    try {
                      return "" === t && o.location.href ? o.location.href : t
                    } catch (e) {
                      return t
                    }
                  }(l.url), !0), "include" === l.credentials ? u.withCredentials = !0 : "omit" === l.credentials && (u.withCredentials = !1), "responseType" in u && (r ? u.responseType = "blob" : a && l.headers.get("Content-Type") && -1 !== l.headers.get("Content-Type").indexOf("application/octet-stream") && (u.responseType = "arraybuffer")), !n || "object" != typeof n.headers || n.headers instanceof f ? l.headers.forEach((function(t, e) {
                    u.setRequestHeader(e, t)
                  })) : Object.getOwnPropertyNames(n.headers).forEach((function(t) {
                    u.setRequestHeader(t, h(n.headers[t]))
                  })), l.signal && (l.signal.addEventListener("abort", c), u.onreadystatechange = function() {
                    4 === u.readyState && l.signal.removeEventListener("abort", c)
                  }), u.send(void 0 === l._bodyInit ? null : l._bodyInit)
                }))
              }
              O.polyfill = !0, o.fetch || (o.fetch = O, o.Headers = f, o.Request = w, o.Response = S), e.Headers = f, e.Request = w, e.Response = S, e.fetch = O
            }({})
          }(i), i.fetch.ponyfill = !0, delete i.fetch.polyfill;
          var r = n.fetch ? n : i;
          (e = r.fetch).default = r.fetch, e.fetch = r.fetch, e.Headers = r.Headers, e.Request = r.Request, e.Response = r.Response, t.exports = e
        },
        3154: function(t, e, o) {
          var n;
          if ("function" == typeof fetch && (n = void 0 !== o.g && o.g.fetch ? o.g.fetch : "undefined" != typeof window && window.fetch ? window.fetch : fetch), "undefined" == typeof window || void 0 === window.document) {
            var i = n || o(4098);
            i.default && (i = i.default), e.default = i, t.exports = e.default
          }
        }
      },
      n = {};

    function i(t) {
      var e = n[t];
      if (void 0 !== e) return e.exports;
      var r = n[t] = {
        exports: {}
      };
      return o[t](r, r.exports, i), r.exports
    }
    e = Object.getPrototypeOf ? function(t) {
      return Object.getPrototypeOf(t)
    } : function(t) {
      return t.__proto__
    }, i.t = function(o, n) {
      if (1 & n && (o = this(o)), 8 & n) return o;
      if ("object" == typeof o && o) {
        if (4 & n && o.__esModule) return o;
        if (16 & n && "function" == typeof o.then) return o
      }
      var r = Object.create(null);
      i.r(r);
      var s = {};
      t = t || [null, e({}), e([]), e(e)];
      for (var a = 2 & n && o;
        "object" == typeof a && !~t.indexOf(a); a = e(a)) Object.getOwnPropertyNames(a).forEach((function(t) {
        s[t] = function() {
          return o[t]
        }
      }));
      return s.default = function() {
        return o
      }, i.d(r, s), r
    }, i.d = function(t, e) {
      for (var o in e) i.o(e, o) && !i.o(t, o) && Object.defineProperty(t, o, {
        enumerable: !0,
        get: e[o]
      })
    }, i.g = function() {
      if ("object" == typeof globalThis) return globalThis;
      try {
        return this || new Function("return this")()
      } catch (t) {
        if ("object" == typeof window) return window
      }
    }(), i.o = function(t, e) {
      return Object.prototype.hasOwnProperty.call(t, e)
    }, i.r = function(t) {
      "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
        value: "Module"
      }), Object.defineProperty(t, "__esModule", {
        value: !0
      })
    };
    var r = {};
    return function() {
      "use strict";
      i.r(r), i.d(r, {
        i18NextHttpBackend: function() {
          return st
        },
        i18next: function() {
          return _
        },
        languageDetector: function() {
          return Pt
        }
      });
      const t = {
        type: "logger",
        log(t) {
          this.output("log", t)
        },
        warn(t) {
          this.output("warn", t)
        },
        error(t) {
          this.output("error", t)
        },
        output(t, e) {
          console && console[t] && console[t].apply(console, e)
        }
      };
      class e {
        constructor(t) {
          let e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
          this.init(t, e)
        }
        init(e) {
          let o = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
          this.prefix = o.prefix || "i18next:", this.logger = e || t, this.options = o, this.debug = o.debug
        }
        log() {
          for (var t = arguments.length, e = new Array(t), o = 0; o < t; o++) e[o] = arguments[o];
          return this.forward(e, "log", "", !0)
        }
        warn() {
          for (var t = arguments.length, e = new Array(t), o = 0; o < t; o++) e[o] = arguments[o];
          return this.forward(e, "warn", "", !0)
        }
        error() {
          for (var t = arguments.length, e = new Array(t), o = 0; o < t; o++) e[o] = arguments[o];
          return this.forward(e, "error", "")
        }
        deprecate() {
          for (var t = arguments.length, e = new Array(t), o = 0; o < t; o++) e[o] = arguments[o];
          return this.forward(e, "warn", "WARNING DEPRECATED: ", !0)
        }
        forward(t, e, o, n) {
          return n && !this.debug ? null : ("string" == typeof t[0] && (t[0] = `${o}${this.prefix} ${t[0]}`), this.logger[e](t))
        }
        create(t) {
          return new e(this.logger, {
            prefix: `${this.prefix}:${t}:`,
            ...this.options
          })
        }
        clone(t) {
          return (t = t || this.options).prefix = t.prefix || this.prefix, new e(this.logger, t)
        }
      }
      var o = new e;
      class n {
        constructor() {
          this.observers = {}
        }
        on(t, e) {
          return t.split(" ").forEach((t => {
            this.observers[t] = this.observers[t] || [], this.observers[t].push(e)
          })), this
        }
        off(t, e) {
          this.observers[t] && (e ? this.observers[t] = this.observers[t].filter((t => t !== e)) : delete this.observers[t])
        }
        emit(t) {
          for (var e = arguments.length, o = new Array(e > 1 ? e - 1 : 0), n = 1; n < e; n++) o[n - 1] = arguments[n];
          this.observers[t] && [].concat(this.observers[t]).forEach((t => {
            t(...o)
          })), this.observers["*"] && [].concat(this.observers["*"]).forEach((e => {
            e.apply(e, [t, ...o])
          }))
        }
      }

      function s() {
        let t, e;
        const o = new Promise(((o, n) => {
          t = o, e = n
        }));
        return o.resolve = t, o.reject = e, o
      }

      function a(t) {
        return null == t ? "" : "" + t
      }

      function l(t, e, o) {
        function n(t) {
          return t && t.indexOf("###") > -1 ? t.replace(/###/g, ".") : t
        }

        function i() {
          return !t || "string" == typeof t
        }
        const r = "string" != typeof e ? [].concat(e) : e.split(".");
        for (; r.length > 1;) {
          if (i()) return {};
          const e = n(r.shift());
          !t[e] && o && (t[e] = new o), t = Object.prototype.hasOwnProperty.call(t, e) ? t[e] : {}
        }
        return i() ? {} : {
          obj: t,
          k: n(r.shift())
        }
      }

      function u(t, e, o) {
        const {
          obj: n,
          k: i
        } = l(t, e, Object);
        n[i] = o
      }

      function c(t, e) {
        const {
          obj: o,
          k: n
        } = l(t, e);
        if (o) return o[n]
      }

      function h(t, e, o) {
        for (const n in e) "__proto__" !== n && "constructor" !== n && (n in t ? "string" == typeof t[n] || t[n] instanceof String || "string" == typeof e[n] || e[n] instanceof String ? o && (t[n] = e[n]) : h(t[n], e[n], o) : t[n] = e[n]);
        return t
      }

      function p(t) {
        return t.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&")
      }
      var f = {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#39;",
        "/": "&#x2F;"
      };

      function d(t) {
        return "string" == typeof t ? t.replace(/[&<>"'\/]/g, (t => f[t])) : t
      }
      const g = [" ", ",", "?", "!", ";"];

      function y(t, e) {
        let o = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : ".";
        if (!t) return;
        if (t[e]) return t[e];
        const n = e.split(o);
        let i = t;
        for (let t = 0; t < n.length; ++t) {
          if (!i) return;
          if ("string" == typeof i[n[t]] && t + 1 < n.length) return;
          if (void 0 === i[n[t]]) {
            let r = 2,
              s = n.slice(t, t + r).join(o),
              a = i[s];
            for (; void 0 === a && n.length > t + r;) r++, s = n.slice(t, t + r).join(o), a = i[s];
            if (void 0 === a) return;
            if (null === a) return null;
            if (e.endsWith(s)) {
              if ("string" == typeof a) return a;
              if (s && "string" == typeof a[s]) return a[s]
            }
            const l = n.slice(t + r).join(o);
            return l ? y(a, l, o) : void 0
          }
          i = i[n[t]]
        }
        return i
      }

      function m(t) {
        return t && t.indexOf("_") > 0 ? t.replace("_", "-") : t
      }
      class v extends n {
        constructor(t) {
          let e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {
            ns: ["translation"],
            defaultNS: "translation"
          };
          super(), this.data = t || {}, this.options = e, void 0 === this.options.keySeparator && (this.options.keySeparator = "."), void 0 === this.options.ignoreJSONStructure && (this.options.ignoreJSONStructure = !0)
        }
        addNamespaces(t) {
          this.options.ns.indexOf(t) < 0 && this.options.ns.push(t)
        }
        removeNamespaces(t) {
          const e = this.options.ns.indexOf(t);
          e > -1 && this.options.ns.splice(e, 1)
        }
        getResource(t, e, o) {
          let n = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {};
          const i = void 0 !== n.keySeparator ? n.keySeparator : this.options.keySeparator,
            r = void 0 !== n.ignoreJSONStructure ? n.ignoreJSONStructure : this.options.ignoreJSONStructure;
          let s = [t, e];
          o && "string" != typeof o && (s = s.concat(o)), o && "string" == typeof o && (s = s.concat(i ? o.split(i) : o)), t.indexOf(".") > -1 && (s = t.split("."));
          const a = c(this.data, s);
          return a || !r || "string" != typeof o ? a : y(this.data && this.data[t] && this.data[t][e], o, i)
        }
        addResource(t, e, o, n) {
          let i = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : {
            silent: !1
          };
          const r = void 0 !== i.keySeparator ? i.keySeparator : this.options.keySeparator;
          let s = [t, e];
          o && (s = s.concat(r ? o.split(r) : o)), t.indexOf(".") > -1 && (s = t.split("."), n = e, e = s[1]), this.addNamespaces(e), u(this.data, s, n), i.silent || this.emit("added", t, e, o, n)
        }
        addResources(t, e, o) {
          let n = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {
            silent: !1
          };
          for (const n in o) "string" != typeof o[n] && "[object Array]" !== Object.prototype.toString.apply(o[n]) || this.addResource(t, e, n, o[n], {
            silent: !0
          });
          n.silent || this.emit("added", t, e, o)
        }
        addResourceBundle(t, e, o, n, i) {
          let r = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : {
              silent: !1
            },
            s = [t, e];
          t.indexOf(".") > -1 && (s = t.split("."), n = o, o = e, e = s[1]), this.addNamespaces(e);
          let a = c(this.data, s) || {};
          n ? h(a, o, i) : a = {
            ...a,
            ...o
          }, u(this.data, s, a), r.silent || this.emit("added", t, e, o)
        }
        removeResourceBundle(t, e) {
          this.hasResourceBundle(t, e) && delete this.data[t][e], this.removeNamespaces(e), this.emit("removed", t, e)
        }
        hasResourceBundle(t, e) {
          return void 0 !== this.getResource(t, e)
        }
        getResourceBundle(t, e) {
          return e || (e = this.options.defaultNS), "v1" === this.options.compatibilityAPI ? {
            ...this.getResource(t, e)
          } : this.getResource(t, e)
        }
        getDataByLanguage(t) {
          return this.data[t]
        }
        hasLanguageSomeTranslations(t) {
          const e = this.getDataByLanguage(t);
          return !!(e && Object.keys(e) || []).find((t => e[t] && Object.keys(e[t]).length > 0))
        }
        toJSON() {
          return this.data
        }
      }
      var b = {
        processors: {},
        addPostProcessor(t) {
          this.processors[t.name] = t
        },
        handle(t, e, o, n, i) {
          return t.forEach((t => {
            this.processors[t] && (e = this.processors[t].process(e, o, n, i))
          })), e
        }
      };
      const w = {};
      class x extends n {
        constructor(t) {
          let e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
          var n, i;
          super(), n = t, i = this, ["resourceStore", "languageUtils", "pluralResolver", "interpolator", "backendConnector", "i18nFormat", "utils"].forEach((t => {
            n[t] && (i[t] = n[t])
          })), this.options = e, void 0 === this.options.keySeparator && (this.options.keySeparator = "."), this.logger = o.create("translator")
        }
        changeLanguage(t) {
          t && (this.language = t)
        }
        exists(t) {
          let e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {
            interpolation: {}
          };
          if (null == t) return !1;
          const o = this.resolve(t, e);
          return o && void 0 !== o.res
        }
        extractFromKey(t, e) {
          let o = void 0 !== e.nsSeparator ? e.nsSeparator : this.options.nsSeparator;
          void 0 === o && (o = ":");
          const n = void 0 !== e.keySeparator ? e.keySeparator : this.options.keySeparator;
          let i = e.ns || this.options.defaultNS || [];
          const r = o && t.indexOf(o) > -1,
            s = !(this.options.userDefinedKeySeparator || e.keySeparator || this.options.userDefinedNsSeparator || e.nsSeparator || function(t, e, o) {
              e = e || "", o = o || "";
              const n = g.filter((t => e.indexOf(t) < 0 && o.indexOf(t) < 0));
              if (0 === n.length) return !0;
              const i = new RegExp(`(${n.map((t=>"?"===t?"\\?":t)).join("|")})`);
              let r = !i.test(t);
              if (!r) {
                const e = t.indexOf(o);
                e > 0 && !i.test(t.substring(0, e)) && (r = !0)
              }
              return r
            }(t, o, n));
          if (r && !s) {
            const e = t.match(this.interpolator.nestingRegexp);
            if (e && e.length > 0) return {
              key: t,
              namespaces: i
            };
            const r = t.split(o);
            (o !== n || o === n && this.options.ns.indexOf(r[0]) > -1) && (i = r.shift()), t = r.join(n)
          }
          return "string" == typeof i && (i = [i]), {
            key: t,
            namespaces: i
          }
        }
        translate(t, e, o) {
          if ("object" != typeof e && this.options.overloadTranslationOptionHandler && (e = this.options.overloadTranslationOptionHandler(arguments)), "object" == typeof e && (e = {
              ...e
            }), e || (e = {}), null == t) return "";
          Array.isArray(t) || (t = [String(t)]);
          const n = void 0 !== e.returnDetails ? e.returnDetails : this.options.returnDetails,
            i = void 0 !== e.keySeparator ? e.keySeparator : this.options.keySeparator,
            {
              key: r,
              namespaces: s
            } = this.extractFromKey(t[t.length - 1], e),
            a = s[s.length - 1],
            l = e.lng || this.language,
            u = e.appendNamespaceToCIMode || this.options.appendNamespaceToCIMode;
          if (l && "cimode" === l.toLowerCase()) {
            if (u) {
              const t = e.nsSeparator || this.options.nsSeparator;
              return n ? {
                res: `${a}${t}${r}`,
                usedKey: r,
                exactUsedKey: r,
                usedLng: l,
                usedNS: a,
                usedParams: this.getUsedParamsDetails(e)
              } : `${a}${t}${r}`
            }
            return n ? {
              res: r,
              usedKey: r,
              exactUsedKey: r,
              usedLng: l,
              usedNS: a,
              usedParams: this.getUsedParamsDetails(e)
            } : r
          }
          const c = this.resolve(t, e);
          let h = c && c.res;
          const p = c && c.usedKey || r,
            f = c && c.exactUsedKey || r,
            d = Object.prototype.toString.apply(h),
            g = void 0 !== e.joinArrays ? e.joinArrays : this.options.joinArrays,
            y = !this.i18nFormat || this.i18nFormat.handleAsObject;
          if (y && h && "string" != typeof h && "boolean" != typeof h && "number" != typeof h && ["[object Number]", "[object Function]", "[object RegExp]"].indexOf(d) < 0 && ("string" != typeof g || "[object Array]" !== d)) {
            if (!e.returnObjects && !this.options.returnObjects) {
              this.options.returnedObjectHandler || this.logger.warn("accessing an object - but returnObjects options is not enabled!");
              const t = this.options.returnedObjectHandler ? this.options.returnedObjectHandler(p, h, {
                ...e,
                ns: s
              }) : `key '${r} (${this.language})' returned an object instead of string.`;
              return n ? (c.res = t, c.usedParams = this.getUsedParamsDetails(e), c) : t
            }
            if (i) {
              const t = "[object Array]" === d,
                o = t ? [] : {},
                n = t ? f : p;
              for (const t in h)
                if (Object.prototype.hasOwnProperty.call(h, t)) {
                  const r = `${n}${i}${t}`;
                  o[t] = this.translate(r, {
                    ...e,
                    joinArrays: !1,
                    ns: s
                  }), o[t] === r && (o[t] = h[t])
                } h = o
            }
          } else if (y && "string" == typeof g && "[object Array]" === d) h = h.join(g), h && (h = this.extendTranslation(h, t, e, o));
          else {
            let n = !1,
              s = !1;
            const u = void 0 !== e.count && "string" != typeof e.count,
              p = x.hasDefaultValue(e),
              f = u ? this.pluralResolver.getSuffix(l, e.count, e) : "",
              d = e.ordinal && u ? this.pluralResolver.getSuffix(l, e.count, {
                ordinal: !1
              }) : "",
              g = u && !e.ordinal && 0 === e.count && this.pluralResolver.shouldUseIntlApi(),
              y = g && e[`defaultValue${this.options.pluralSeparator}zero`] || e[`defaultValue${f}`] || e[`defaultValue${d}`] || e.defaultValue;
            !this.isValidLookup(h) && p && (n = !0, h = y), this.isValidLookup(h) || (s = !0, h = r);
            const m = (e.missingKeyNoValueFallbackToKey || this.options.missingKeyNoValueFallbackToKey) && s ? void 0 : h,
              v = p && y !== h && this.options.updateMissing;
            if (s || n || v) {
              if (this.logger.log(v ? "updateKey" : "missingKey", l, a, r, v ? y : h), i) {
                const t = this.resolve(r, {
                  ...e,
                  keySeparator: !1
                });
                t && t.res && this.logger.warn("Seems the loaded translations were in flat JSON format instead of nested. Either set keySeparator: false on init or make sure your translations are published in nested format.")
              }
              let t = [];
              const o = this.languageUtils.getFallbackCodes(this.options.fallbackLng, e.lng || this.language);
              if ("fallback" === this.options.saveMissingTo && o && o[0])
                for (let e = 0; e < o.length; e++) t.push(o[e]);
              else "all" === this.options.saveMissingTo ? t = this.languageUtils.toResolveHierarchy(e.lng || this.language) : t.push(e.lng || this.language);
              const n = (t, o, n) => {
                const i = p && n !== h ? n : m;
                this.options.missingKeyHandler ? this.options.missingKeyHandler(t, a, o, i, v, e) : this.backendConnector && this.backendConnector.saveMissing && this.backendConnector.saveMissing(t, a, o, i, v, e), this.emit("missingKey", t, a, o, h)
              };
              this.options.saveMissing && (this.options.saveMissingPlurals && u ? t.forEach((t => {
                const o = this.pluralResolver.getSuffixes(t, e);
                g && e[`defaultValue${this.options.pluralSeparator}zero`] && o.indexOf(`${this.options.pluralSeparator}zero`) < 0 && o.push(`${this.options.pluralSeparator}zero`), o.forEach((o => {
                  n([t], r + o, e[`defaultValue${o}`] || y)
                }))
              })) : n(t, r, y))
            }
            h = this.extendTranslation(h, t, e, c, o), s && h === r && this.options.appendNamespaceToMissingKey && (h = `${a}:${r}`), (s || n) && this.options.parseMissingKeyHandler && (h = "v1" !== this.options.compatibilityAPI ? this.options.parseMissingKeyHandler(this.options.appendNamespaceToMissingKey ? `${a}:${r}` : r, n ? h : void 0) : this.options.parseMissingKeyHandler(h))
          }
          return n ? (c.res = h, c.usedParams = this.getUsedParamsDetails(e), c) : h
        }
        extendTranslation(t, e, o, n, i) {
          var r = this;
          if (this.i18nFormat && this.i18nFormat.parse) t = this.i18nFormat.parse(t, {
            ...this.options.interpolation.defaultVariables,
            ...o
          }, o.lng || this.language || n.usedLng, n.usedNS, n.usedKey, {
            resolved: n
          });
          else if (!o.skipInterpolation) {
            o.interpolation && this.interpolator.init({
              ...o,
              interpolation: {
                ...this.options.interpolation,
                ...o.interpolation
              }
            });
            const s = "string" == typeof t && (o && o.interpolation && void 0 !== o.interpolation.skipOnVariables ? o.interpolation.skipOnVariables : this.options.interpolation.skipOnVariables);
            let a;
            if (s) {
              const e = t.match(this.interpolator.nestingRegexp);
              a = e && e.length
            }
            let l = o.replace && "string" != typeof o.replace ? o.replace : o;
            if (this.options.interpolation.defaultVariables && (l = {
                ...this.options.interpolation.defaultVariables,
                ...l
              }), t = this.interpolator.interpolate(t, l, o.lng || this.language, o), s) {
              const e = t.match(this.interpolator.nestingRegexp);
              a < (e && e.length) && (o.nest = !1)
            }!o.lng && "v1" !== this.options.compatibilityAPI && n && n.res && (o.lng = n.usedLng), !1 !== o.nest && (t = this.interpolator.nest(t, (function() {
              for (var t = arguments.length, n = new Array(t), s = 0; s < t; s++) n[s] = arguments[s];
              return i && i[0] === n[0] && !o.context ? (r.logger.warn(`It seems you are nesting recursively key: ${n[0]} in key: ${e[0]}`), null) : r.translate(...n, e)
            }), o)), o.interpolation && this.interpolator.reset()
          }
          const s = o.postProcess || this.options.postProcess,
            a = "string" == typeof s ? [s] : s;
          return null != t && a && a.length && !1 !== o.applyPostProcessor && (t = b.handle(a, t, e, this.options && this.options.postProcessPassResolved ? {
            i18nResolved: {
              ...n,
              usedParams: this.getUsedParamsDetails(o)
            },
            ...o
          } : o, this)), t
        }
        resolve(t) {
          let e, o, n, i, r, s = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
          return "string" == typeof t && (t = [t]), t.forEach((t => {
            if (this.isValidLookup(e)) return;
            const a = this.extractFromKey(t, s),
              l = a.key;
            o = l;
            let u = a.namespaces;
            this.options.fallbackNS && (u = u.concat(this.options.fallbackNS));
            const c = void 0 !== s.count && "string" != typeof s.count,
              h = c && !s.ordinal && 0 === s.count && this.pluralResolver.shouldUseIntlApi(),
              p = void 0 !== s.context && ("string" == typeof s.context || "number" == typeof s.context) && "" !== s.context,
              f = s.lngs ? s.lngs : this.languageUtils.toResolveHierarchy(s.lng || this.language, s.fallbackLng);
            u.forEach((t => {
              this.isValidLookup(e) || (r = t, !w[`${f[0]}-${t}`] && this.utils && this.utils.hasLoadedNamespace && !this.utils.hasLoadedNamespace(r) && (w[`${f[0]}-${t}`] = !0, this.logger.warn(`key "${o}" for languages "${f.join(", ")}" won't get resolved as namespace "${r}" was not yet loaded`, "This means something IS WRONG in your setup. You access the t function before i18next.init / i18next.loadNamespace / i18next.changeLanguage was done. Wait for the callback or Promise to resolve before accessing it!!!")), f.forEach((o => {
                if (this.isValidLookup(e)) return;
                i = o;
                const r = [l];
                if (this.i18nFormat && this.i18nFormat.addLookupKeys) this.i18nFormat.addLookupKeys(r, l, o, t, s);
                else {
                  let t;
                  c && (t = this.pluralResolver.getSuffix(o, s.count, s));
                  const e = `${this.options.pluralSeparator}zero`,
                    n = `${this.options.pluralSeparator}ordinal${this.options.pluralSeparator}`;
                  if (c && (r.push(l + t), s.ordinal && 0 === t.indexOf(n) && r.push(l + t.replace(n, this.options.pluralSeparator)), h && r.push(l + e)), p) {
                    const o = `${l}${this.options.contextSeparator}${s.context}`;
                    r.push(o), c && (r.push(o + t), s.ordinal && 0 === t.indexOf(n) && r.push(o + t.replace(n, this.options.pluralSeparator)), h && r.push(o + e))
                  }
                }
                let a;
                for (; a = r.pop();) this.isValidLookup(e) || (n = a, e = this.getResource(o, t, a, s))
              })))
            }))
          })), {
            res: e,
            usedKey: o,
            exactUsedKey: n,
            usedLng: i,
            usedNS: r
          }
        }
        isValidLookup(t) {
          return !(void 0 === t || !this.options.returnNull && null === t || !this.options.returnEmptyString && "" === t)
        }
        getResource(t, e, o) {
          let n = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {};
          return this.i18nFormat && this.i18nFormat.getResource ? this.i18nFormat.getResource(t, e, o, n) : this.resourceStore.getResource(t, e, o, n)
        }
        getUsedParamsDetails() {
          let t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
          const e = ["defaultValue", "ordinal", "context", "replace", "lng", "lngs", "fallbackLng", "ns", "keySeparator", "nsSeparator", "returnObjects", "returnDetails", "joinArrays", "postProcess", "interpolation"],
            o = t.replace && "string" != typeof t.replace;
          let n = o ? t.replace : t;
          if (o && void 0 !== t.count && (n.count = t.count), this.options.interpolation.defaultVariables && (n = {
              ...this.options.interpolation.defaultVariables,
              ...n
            }), !o) {
            n = {
              ...n
            };
            for (const t of e) delete n[t]
          }
          return n
        }
        static hasDefaultValue(t) {
          for (const e in t)
            if (Object.prototype.hasOwnProperty.call(t, e) && "defaultValue" === e.substring(0, 12) && void 0 !== t[e]) return !0;
          return !1
        }
      }

      function S(t) {
        return t.charAt(0).toUpperCase() + t.slice(1)
      }
      class k {
        constructor(t) {
          this.options = t, this.supportedLngs = this.options.supportedLngs || !1, this.logger = o.create("languageUtils")
        }
        getScriptPartFromCode(t) {
          if (!(t = m(t)) || t.indexOf("-") < 0) return null;
          const e = t.split("-");
          return 2 === e.length ? null : (e.pop(), "x" === e[e.length - 1].toLowerCase() ? null : this.formatLanguageCode(e.join("-")))
        }
        getLanguagePartFromCode(t) {
          if (!(t = m(t)) || t.indexOf("-") < 0) return t;
          const e = t.split("-");
          return this.formatLanguageCode(e[0])
        }
        formatLanguageCode(t) {
          if ("string" == typeof t && t.indexOf("-") > -1) {
            const e = ["hans", "hant", "latn", "cyrl", "cans", "mong", "arab"];
            let o = t.split("-");
            return this.options.lowerCaseLng ? o = o.map((t => t.toLowerCase())) : 2 === o.length ? (o[0] = o[0].toLowerCase(), o[1] = o[1].toUpperCase(), e.indexOf(o[1].toLowerCase()) > -1 && (o[1] = S(o[1].toLowerCase()))) : 3 === o.length && (o[0] = o[0].toLowerCase(), 2 === o[1].length && (o[1] = o[1].toUpperCase()), "sgn" !== o[0] && 2 === o[2].length && (o[2] = o[2].toUpperCase()), e.indexOf(o[1].toLowerCase()) > -1 && (o[1] = S(o[1].toLowerCase())), e.indexOf(o[2].toLowerCase()) > -1 && (o[2] = S(o[2].toLowerCase()))), o.join("-")
          }
          return this.options.cleanCode || this.options.lowerCaseLng ? t.toLowerCase() : t
        }
        isSupportedCode(t) {
          return ("languageOnly" === this.options.load || this.options.nonExplicitSupportedLngs) && (t = this.getLanguagePartFromCode(t)), !this.supportedLngs || !this.supportedLngs.length || this.supportedLngs.indexOf(t) > -1
        }
        getBestMatchFromCodes(t) {
          if (!t) return null;
          let e;
          return t.forEach((t => {
            if (e) return;
            const o = this.formatLanguageCode(t);
            this.options.supportedLngs && !this.isSupportedCode(o) || (e = o)
          })), !e && this.options.supportedLngs && t.forEach((t => {
            if (e) return;
            const o = this.getLanguagePartFromCode(t);
            if (this.isSupportedCode(o)) return e = o;
            e = this.options.supportedLngs.find((t => t === o ? t : t.indexOf("-") < 0 && o.indexOf("-") < 0 ? void 0 : 0 === t.indexOf(o) ? t : void 0))
          })), e || (e = this.getFallbackCodes(this.options.fallbackLng)[0]), e
        }
        getFallbackCodes(t, e) {
          if (!t) return [];
          if ("function" == typeof t && (t = t(e)), "string" == typeof t && (t = [t]), "[object Array]" === Object.prototype.toString.apply(t)) return t;
          if (!e) return t.default || [];
          let o = t[e];
          return o || (o = t[this.getScriptPartFromCode(e)]), o || (o = t[this.formatLanguageCode(e)]), o || (o = t[this.getLanguagePartFromCode(e)]), o || (o = t.default), o || []
        }
        toResolveHierarchy(t, e) {
          const o = this.getFallbackCodes(e || this.options.fallbackLng || [], t),
            n = [],
            i = t => {
              t && (this.isSupportedCode(t) ? n.push(t) : this.logger.warn(`rejecting language code not found in supportedLngs: ${t}`))
            };
          return "string" == typeof t && (t.indexOf("-") > -1 || t.indexOf("_") > -1) ? ("languageOnly" !== this.options.load && i(this.formatLanguageCode(t)), "languageOnly" !== this.options.load && "currentOnly" !== this.options.load && i(this.getScriptPartFromCode(t)), "currentOnly" !== this.options.load && i(this.getLanguagePartFromCode(t))) : "string" == typeof t && i(this.formatLanguageCode(t)), o.forEach((t => {
            n.indexOf(t) < 0 && i(this.formatLanguageCode(t))
          })), n
        }
      }
      let O = [{
          lngs: ["ach", "ak", "am", "arn", "br", "fil", "gun", "ln", "mfe", "mg", "mi", "oc", "pt", "pt-BR", "tg", "tl", "ti", "tr", "uz", "wa"],
          nr: [1, 2],
          fc: 1
        }, {
          lngs: ["af", "an", "ast", "az", "bg", "bn", "ca", "da", "de", "dev", "el", "en", "eo", "es", "et", "eu", "fi", "fo", "fur", "fy", "gl", "gu", "ha", "hi", "hu", "hy", "ia", "it", "kk", "kn", "ku", "lb", "mai", "ml", "mn", "mr", "nah", "nap", "nb", "ne", "nl", "nn", "no", "nso", "pa", "pap", "pms", "ps", "pt-PT", "rm", "sco", "se", "si", "so", "son", "sq", "sv", "sw", "ta", "te", "tk", "ur", "yo"],
          nr: [1, 2],
          fc: 2
        }, {
          lngs: ["ay", "bo", "cgg", "fa", "ht", "id", "ja", "jbo", "ka", "km", "ko", "ky", "lo", "ms", "sah", "su", "th", "tt", "ug", "vi", "wo", "zh"],
          nr: [1],
          fc: 3
        }, {
          lngs: ["be", "bs", "cnr", "dz", "hr", "ru", "sr", "uk"],
          nr: [1, 2, 5],
          fc: 4
        }, {
          lngs: ["ar"],
          nr: [0, 1, 2, 3, 11, 100],
          fc: 5
        }, {
          lngs: ["cs", "sk"],
          nr: [1, 2, 5],
          fc: 6
        }, {
          lngs: ["csb", "pl"],
          nr: [1, 2, 5],
          fc: 7
        }, {
          lngs: ["cy"],
          nr: [1, 2, 3, 8],
          fc: 8
        }, {
          lngs: ["fr"],
          nr: [1, 2],
          fc: 9
        }, {
          lngs: ["ga"],
          nr: [1, 2, 3, 7, 11],
          fc: 10
        }, {
          lngs: ["gd"],
          nr: [1, 2, 3, 20],
          fc: 11
        }, {
          lngs: ["is"],
          nr: [1, 2],
          fc: 12
        }, {
          lngs: ["jv"],
          nr: [0, 1],
          fc: 13
        }, {
          lngs: ["kw"],
          nr: [1, 2, 3, 4],
          fc: 14
        }, {
          lngs: ["lt"],
          nr: [1, 2, 10],
          fc: 15
        }, {
          lngs: ["lv"],
          nr: [1, 2, 0],
          fc: 16
        }, {
          lngs: ["mk"],
          nr: [1, 2],
          fc: 17
        }, {
          lngs: ["mnk"],
          nr: [0, 1, 2],
          fc: 18
        }, {
          lngs: ["mt"],
          nr: [1, 2, 11, 20],
          fc: 19
        }, {
          lngs: ["or"],
          nr: [2, 1],
          fc: 2
        }, {
          lngs: ["ro"],
          nr: [1, 2, 20],
          fc: 20
        }, {
          lngs: ["sl"],
          nr: [5, 1, 2, 3],
          fc: 21
        }, {
          lngs: ["he", "iw"],
          nr: [1, 2, 20, 21],
          fc: 22
        }],
        L = {
          1: function(t) {
            return Number(t > 1)
          },
          2: function(t) {
            return Number(1 != t)
          },
          3: function(t) {
            return 0
          },
          4: function(t) {
            return Number(t % 10 == 1 && t % 100 != 11 ? 0 : t % 10 >= 2 && t % 10 <= 4 && (t % 100 < 10 || t % 100 >= 20) ? 1 : 2)
          },
          5: function(t) {
            return Number(0 == t ? 0 : 1 == t ? 1 : 2 == t ? 2 : t % 100 >= 3 && t % 100 <= 10 ? 3 : t % 100 >= 11 ? 4 : 5)
          },
          6: function(t) {
            return Number(1 == t ? 0 : t >= 2 && t <= 4 ? 1 : 2)
          },
          7: function(t) {
            return Number(1 == t ? 0 : t % 10 >= 2 && t % 10 <= 4 && (t % 100 < 10 || t % 100 >= 20) ? 1 : 2)
          },
          8: function(t) {
            return Number(1 == t ? 0 : 2 == t ? 1 : 8 != t && 11 != t ? 2 : 3)
          },
          9: function(t) {
            return Number(t >= 2)
          },
          10: function(t) {
            return Number(1 == t ? 0 : 2 == t ? 1 : t < 7 ? 2 : t < 11 ? 3 : 4)
          },
          11: function(t) {
            return Number(1 == t || 11 == t ? 0 : 2 == t || 12 == t ? 1 : t > 2 && t < 20 ? 2 : 3)
          },
          12: function(t) {
            return Number(t % 10 != 1 || t % 100 == 11)
          },
          13: function(t) {
            return Number(0 !== t)
          },
          14: function(t) {
            return Number(1 == t ? 0 : 2 == t ? 1 : 3 == t ? 2 : 3)
          },
          15: function(t) {
            return Number(t % 10 == 1 && t % 100 != 11 ? 0 : t % 10 >= 2 && (t % 100 < 10 || t % 100 >= 20) ? 1 : 2)
          },
          16: function(t) {
            return Number(t % 10 == 1 && t % 100 != 11 ? 0 : 0 !== t ? 1 : 2)
          },
          17: function(t) {
            return Number(1 == t || t % 10 == 1 && t % 100 != 11 ? 0 : 1)
          },
          18: function(t) {
            return Number(0 == t ? 0 : 1 == t ? 1 : 2)
          },
          19: function(t) {
            return Number(1 == t ? 0 : 0 == t || t % 100 > 1 && t % 100 < 11 ? 1 : t % 100 > 10 && t % 100 < 20 ? 2 : 3)
          },
          20: function(t) {
            return Number(1 == t ? 0 : 0 == t || t % 100 > 0 && t % 100 < 20 ? 1 : 2)
          },
          21: function(t) {
            return Number(t % 100 == 1 ? 1 : t % 100 == 2 ? 2 : t % 100 == 3 || t % 100 == 4 ? 3 : 0)
          },
          22: function(t) {
            return Number(1 == t ? 0 : 2 == t ? 1 : (t < 0 || t > 10) && t % 10 == 0 ? 2 : 3)
          }
        };
      const P = ["v1", "v2", "v3"],
        R = ["v4"],
        j = {
          zero: 0,
          one: 1,
          two: 2,
          few: 3,
          many: 4,
          other: 5
        };
      class E {
        constructor(t) {
          let e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
          this.languageUtils = t, this.options = e, this.logger = o.create("pluralResolver"), this.options.compatibilityJSON && !R.includes(this.options.compatibilityJSON) || "undefined" != typeof Intl && Intl.PluralRules || (this.options.compatibilityJSON = "v3", this.logger.error("Your environment seems not to be Intl API compatible, use an Intl.PluralRules polyfill. Will fallback to the compatibilityJSON v3 format handling.")), this.rules = function() {
            const t = {};
            return O.forEach((e => {
              e.lngs.forEach((o => {
                t[o] = {
                  numbers: e.nr,
                  plurals: L[e.fc]
                }
              }))
            })), t
          }()
        }
        addRule(t, e) {
          this.rules[t] = e
        }
        getRule(t) {
          let e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
          if (this.shouldUseIntlApi()) try {
            return new Intl.PluralRules(m("dev" === t ? "en" : t), {
              type: e.ordinal ? "ordinal" : "cardinal"
            })
          } catch (t) {
            return
          }
          return this.rules[t] || this.rules[this.languageUtils.getLanguagePartFromCode(t)]
        }
        needsPlural(t) {
          let e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
          const o = this.getRule(t, e);
          return this.shouldUseIntlApi() ? o && o.resolvedOptions().pluralCategories.length > 1 : o && o.numbers.length > 1
        }
        getPluralFormsOfKey(t, e) {
          let o = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
          return this.getSuffixes(t, o).map((t => `${e}${t}`))
        }
        getSuffixes(t) {
          let e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
          const o = this.getRule(t, e);
          return o ? this.shouldUseIntlApi() ? o.resolvedOptions().pluralCategories.sort(((t, e) => j[t] - j[e])).map((t => `${this.options.prepend}${e.ordinal?`ordinal${this.options.prepend}`:""}${t}`)) : o.numbers.map((o => this.getSuffix(t, o, e))) : []
        }
        getSuffix(t, e) {
          let o = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
          const n = this.getRule(t, o);
          return n ? this.shouldUseIntlApi() ? `${this.options.prepend}${o.ordinal?`ordinal${this.options.prepend}`:""}${n.select(e)}` : this.getSuffixRetroCompatible(n, e) : (this.logger.warn(`no plural rule found for: ${t}`), "")
        }
        getSuffixRetroCompatible(t, e) {
          const o = t.noAbs ? t.plurals(e) : t.plurals(Math.abs(e));
          let n = t.numbers[o];
          this.options.simplifyPluralSuffix && 2 === t.numbers.length && 1 === t.numbers[0] && (2 === n ? n = "plural" : 1 === n && (n = ""));
          const i = () => this.options.prepend && n.toString() ? this.options.prepend + n.toString() : n.toString();
          return "v1" === this.options.compatibilityJSON ? 1 === n ? "" : "number" == typeof n ? `_plural_${n.toString()}` : i() : "v2" === this.options.compatibilityJSON || this.options.simplifyPluralSuffix && 2 === t.numbers.length && 1 === t.numbers[0] ? i() : this.options.prepend && o.toString() ? this.options.prepend + o.toString() : o.toString()
        }
        shouldUseIntlApi() {
          return !P.includes(this.options.compatibilityJSON)
        }
      }

      function C(t, e, o) {
        let n = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : ".",
          i = !(arguments.length > 4 && void 0 !== arguments[4]) || arguments[4],
          r = function(t, e, o) {
            const n = c(t, o);
            return void 0 !== n ? n : c(e, o)
          }(t, e, o);
        return !r && i && "string" == typeof o && (r = y(t, o, n), void 0 === r && (r = y(e, o, n))), r
      }
      class N {
        constructor() {
          let t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
          this.logger = o.create("interpolator"), this.options = t, this.format = t.interpolation && t.interpolation.format || (t => t), this.init(t)
        }
        init() {
          let t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
          t.interpolation || (t.interpolation = {
            escapeValue: !0
          });
          const e = t.interpolation;
          this.escape = void 0 !== e.escape ? e.escape : d, this.escapeValue = void 0 === e.escapeValue || e.escapeValue, this.useRawValueToEscape = void 0 !== e.useRawValueToEscape && e.useRawValueToEscape, this.prefix = e.prefix ? p(e.prefix) : e.prefixEscaped || "{{", this.suffix = e.suffix ? p(e.suffix) : e.suffixEscaped || "}}", this.formatSeparator = e.formatSeparator ? e.formatSeparator : e.formatSeparator || ",", this.unescapePrefix = e.unescapeSuffix ? "" : e.unescapePrefix || "-", this.unescapeSuffix = this.unescapePrefix ? "" : e.unescapeSuffix || "", this.nestingPrefix = e.nestingPrefix ? p(e.nestingPrefix) : e.nestingPrefixEscaped || p("$t("), this.nestingSuffix = e.nestingSuffix ? p(e.nestingSuffix) : e.nestingSuffixEscaped || p(")"), this.nestingOptionsSeparator = e.nestingOptionsSeparator ? e.nestingOptionsSeparator : e.nestingOptionsSeparator || ",", this.maxReplaces = e.maxReplaces ? e.maxReplaces : 1e3, this.alwaysFormat = void 0 !== e.alwaysFormat && e.alwaysFormat, this.resetRegExp()
        }
        reset() {
          this.options && this.init(this.options)
        }
        resetRegExp() {
          const t = `${this.prefix}(.+?)${this.suffix}`;
          this.regexp = new RegExp(t, "g");
          const e = `${this.prefix}${this.unescapePrefix}(.+?)${this.unescapeSuffix}${this.suffix}`;
          this.regexpUnescape = new RegExp(e, "g");
          const o = `${this.nestingPrefix}(.+?)${this.nestingSuffix}`;
          this.nestingRegexp = new RegExp(o, "g")
        }
        interpolate(t, e, o, n) {
          let i, r, s;
          const l = this.options && this.options.interpolation && this.options.interpolation.defaultVariables || {};

          function u(t) {
            return t.replace(/\$/g, "$$$$")
          }
          const c = t => {
            if (t.indexOf(this.formatSeparator) < 0) {
              const i = C(e, l, t, this.options.keySeparator, this.options.ignoreJSONStructure);
              return this.alwaysFormat ? this.format(i, void 0, o, {
                ...n,
                ...e,
                interpolationkey: t
              }) : i
            }
            const i = t.split(this.formatSeparator),
              r = i.shift().trim(),
              s = i.join(this.formatSeparator).trim();
            return this.format(C(e, l, r, this.options.keySeparator, this.options.ignoreJSONStructure), s, o, {
              ...n,
              ...e,
              interpolationkey: r
            })
          };
          this.resetRegExp();
          const h = n && n.missingInterpolationHandler || this.options.missingInterpolationHandler,
            p = n && n.interpolation && void 0 !== n.interpolation.skipOnVariables ? n.interpolation.skipOnVariables : this.options.interpolation.skipOnVariables;
          return [{
            regex: this.regexpUnescape,
            safeValue: t => u(t)
          }, {
            regex: this.regexp,
            safeValue: t => this.escapeValue ? u(this.escape(t)) : u(t)
          }].forEach((e => {
            for (s = 0; i = e.regex.exec(t);) {
              const o = i[1].trim();
              if (r = c(o), void 0 === r)
                if ("function" == typeof h) {
                  const e = h(t, i, n);
                  r = "string" == typeof e ? e : ""
                } else if (n && Object.prototype.hasOwnProperty.call(n, o)) r = "";
              else {
                if (p) {
                  r = i[0];
                  continue
                }
                this.logger.warn(`missed to pass in variable ${o} for interpolating ${t}`), r = ""
              } else "string" == typeof r || this.useRawValueToEscape || (r = a(r));
              const l = e.safeValue(r);
              if (t = t.replace(i[0], l), p ? (e.regex.lastIndex += r.length, e.regex.lastIndex -= i[0].length) : e.regex.lastIndex = 0, s++, s >= this.maxReplaces) break
            }
          })), t
        }
        nest(t, e) {
          let o, n, i, r = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};

          function s(t, e) {
            const o = this.nestingOptionsSeparator;
            if (t.indexOf(o) < 0) return t;
            const n = t.split(new RegExp(`${o}[ ]*{`));
            let r = `{${n[1]}`;
            t = n[0], r = this.interpolate(r, i);
            const s = r.match(/'/g),
              a = r.match(/"/g);
            (s && s.length % 2 == 0 && !a || a.length % 2 != 0) && (r = r.replace(/'/g, '"'));
            try {
              i = JSON.parse(r), e && (i = {
                ...e,
                ...i
              })
            } catch (e) {
              return this.logger.warn(`failed parsing options string in nesting for key ${t}`, e), `${t}${o}${r}`
            }
            return delete i.defaultValue, t
          }
          for (; o = this.nestingRegexp.exec(t);) {
            let l = [];
            i = {
              ...r
            }, i = i.replace && "string" != typeof i.replace ? i.replace : i, i.applyPostProcessor = !1, delete i.defaultValue;
            let u = !1;
            if (-1 !== o[0].indexOf(this.formatSeparator) && !/{.*}/.test(o[1])) {
              const t = o[1].split(this.formatSeparator).map((t => t.trim()));
              o[1] = t.shift(), l = t, u = !0
            }
            if (n = e(s.call(this, o[1].trim(), i), i), n && o[0] === t && "string" != typeof n) return n;
            "string" != typeof n && (n = a(n)), n || (this.logger.warn(`missed to resolve ${o[1]} for nesting ${t}`), n = ""), u && (n = l.reduce(((t, e) => this.format(t, e, r.lng, {
              ...r,
              interpolationkey: o[1].trim()
            })), n.trim())), t = t.replace(o[0], n), this.regexp.lastIndex = 0
          }
          return t
        }
      }

      function T(t) {
        const e = {};
        return function(o, n, i) {
          const r = n + JSON.stringify(i);
          let s = e[r];
          return s || (s = t(m(n), i), e[r] = s), s(o)
        }
      }
      class A {
        constructor() {
          let t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
          this.logger = o.create("formatter"), this.options = t, this.formats = {
            number: T(((t, e) => {
              const o = new Intl.NumberFormat(t, {
                ...e
              });
              return t => o.format(t)
            })),
            currency: T(((t, e) => {
              const o = new Intl.NumberFormat(t, {
                ...e,
                style: "currency"
              });
              return t => o.format(t)
            })),
            datetime: T(((t, e) => {
              const o = new Intl.DateTimeFormat(t, {
                ...e
              });
              return t => o.format(t)
            })),
            relativetime: T(((t, e) => {
              const o = new Intl.RelativeTimeFormat(t, {
                ...e
              });
              return t => o.format(t, e.range || "day")
            })),
            list: T(((t, e) => {
              const o = new Intl.ListFormat(t, {
                ...e
              });
              return t => o.format(t)
            }))
          }, this.init(t)
        }
        init(t) {
          const e = (arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {
            interpolation: {}
          }).interpolation;
          this.formatSeparator = e.formatSeparator ? e.formatSeparator : e.formatSeparator || ","
        }
        add(t, e) {
          this.formats[t.toLowerCase().trim()] = e
        }
        addCached(t, e) {
          this.formats[t.toLowerCase().trim()] = T(e)
        }
        format(t, e, o) {
          let n = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {};
          return e.split(this.formatSeparator).reduce(((t, e) => {
            const {
              formatName: i,
              formatOptions: r
            } = function(t) {
              let e = t.toLowerCase().trim();
              const o = {};
              if (t.indexOf("(") > -1) {
                const n = t.split("(");
                e = n[0].toLowerCase().trim();
                const i = n[1].substring(0, n[1].length - 1);
                "currency" === e && i.indexOf(":") < 0 ? o.currency || (o.currency = i.trim()) : "relativetime" === e && i.indexOf(":") < 0 ? o.range || (o.range = i.trim()) : i.split(";").forEach((t => {
                  if (!t) return;
                  const [e, ...n] = t.split(":"), i = n.join(":").trim().replace(/^'+|'+$/g, "");
                  o[e.trim()] || (o[e.trim()] = i), "false" === i && (o[e.trim()] = !1), "true" === i && (o[e.trim()] = !0), isNaN(i) || (o[e.trim()] = parseInt(i, 10))
                }))
              }
              return {
                formatName: e,
                formatOptions: o
              }
            }(e);
            if (this.formats[i]) {
              let e = t;
              try {
                const s = n && n.formatParams && n.formatParams[n.interpolationkey] || {},
                  a = s.locale || s.lng || n.locale || n.lng || o;
                e = this.formats[i](t, a, {
                  ...r,
                  ...n,
                  ...s
                })
              } catch (t) {
                this.logger.warn(t)
              }
              return e
            }
            return this.logger.warn(`there was no format function for ${i}`), t
          }), t)
        }
      }
      class $ extends n {
        constructor(t, e, n) {
          let i = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {};
          super(), this.backend = t, this.store = e, this.services = n, this.languageUtils = n.languageUtils, this.options = i, this.logger = o.create("backendConnector"), this.waitingReads = [], this.maxParallelReads = i.maxParallelReads || 10, this.readingCalls = 0, this.maxRetries = i.maxRetries >= 0 ? i.maxRetries : 5, this.retryTimeout = i.retryTimeout >= 1 ? i.retryTimeout : 350, this.state = {}, this.queue = [], this.backend && this.backend.init && this.backend.init(n, i.backend, i)
        }
        queueLoad(t, e, o, n) {
          const i = {},
            r = {},
            s = {},
            a = {};
          return t.forEach((t => {
            let n = !0;
            e.forEach((e => {
              const s = `${t}|${e}`;
              !o.reload && this.store.hasResourceBundle(t, e) ? this.state[s] = 2 : this.state[s] < 0 || (1 === this.state[s] ? void 0 === r[s] && (r[s] = !0) : (this.state[s] = 1, n = !1, void 0 === r[s] && (r[s] = !0), void 0 === i[s] && (i[s] = !0), void 0 === a[e] && (a[e] = !0)))
            })), n || (s[t] = !0)
          })), (Object.keys(i).length || Object.keys(r).length) && this.queue.push({
            pending: r,
            pendingCount: Object.keys(r).length,
            loaded: {},
            errors: [],
            callback: n
          }), {
            toLoad: Object.keys(i),
            pending: Object.keys(r),
            toLoadLanguages: Object.keys(s),
            toLoadNamespaces: Object.keys(a)
          }
        }
        loaded(t, e, o) {
          const n = t.split("|"),
            i = n[0],
            r = n[1];
          e && this.emit("failedLoading", i, r, e), o && this.store.addResourceBundle(i, r, o), this.state[t] = e ? -1 : 2;
          const s = {};
          this.queue.forEach((o => {
            ! function(t, e, o, n) {
              const {
                obj: i,
                k: r
              } = l(t, e, Object);
              i[r] = i[r] || [], i[r].push(o)
            }(o.loaded, [i], r),
            function(t, e) {
              void 0 !== t.pending[e] && (delete t.pending[e], t.pendingCount--)
            }(o, t), e && o.errors.push(e), 0 !== o.pendingCount || o.done || (Object.keys(o.loaded).forEach((t => {
              s[t] || (s[t] = {});
              const e = o.loaded[t];
              e.length && e.forEach((e => {
                void 0 === s[t][e] && (s[t][e] = !0)
              }))
            })), o.done = !0, o.errors.length ? o.callback(o.errors) : o.callback())
          })), this.emit("loaded", s), this.queue = this.queue.filter((t => !t.done))
        }
        read(t, e, o) {
          let n = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : 0,
            i = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : this.retryTimeout,
            r = arguments.length > 5 ? arguments[5] : void 0;
          if (!t.length) return r(null, {});
          if (this.readingCalls >= this.maxParallelReads) return void this.waitingReads.push({
            lng: t,
            ns: e,
            fcName: o,
            tried: n,
            wait: i,
            callback: r
          });
          this.readingCalls++;
          const s = (s, a) => {
              if (this.readingCalls--, this.waitingReads.length > 0) {
                const t = this.waitingReads.shift();
                this.read(t.lng, t.ns, t.fcName, t.tried, t.wait, t.callback)
              }
              s && a && n < this.maxRetries ? setTimeout((() => {
                this.read.call(this, t, e, o, n + 1, 2 * i, r)
              }), i) : r(s, a)
            },
            a = this.backend[o].bind(this.backend);
          if (2 !== a.length) return a(t, e, s);
          try {
            const o = a(t, e);
            o && "function" == typeof o.then ? o.then((t => s(null, t))).catch(s) : s(null, o)
          } catch (t) {
            s(t)
          }
        }
        prepareLoading(t, e) {
          let o = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {},
            n = arguments.length > 3 ? arguments[3] : void 0;
          if (!this.backend) return this.logger.warn("No backend was added via i18next.use. Will not load resources."), n && n();
          "string" == typeof t && (t = this.languageUtils.toResolveHierarchy(t)), "string" == typeof e && (e = [e]);
          const i = this.queueLoad(t, e, o, n);
          if (!i.toLoad.length) return i.pending.length || n(), null;
          i.toLoad.forEach((t => {
            this.loadOne(t)
          }))
        }
        load(t, e, o) {
          this.prepareLoading(t, e, {}, o)
        }
        reload(t, e, o) {
          this.prepareLoading(t, e, {
            reload: !0
          }, o)
        }
        loadOne(t) {
          let e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "";
          const o = t.split("|"),
            n = o[0],
            i = o[1];
          this.read(n, i, "read", void 0, void 0, ((o, r) => {
            o && this.logger.warn(`${e}loading namespace ${i} for language ${n} failed`, o), !o && r && this.logger.log(`${e}loaded namespace ${i} for language ${n}`, r), this.loaded(t, o, r)
          }))
        }
        saveMissing(t, e, o, n, i) {
          let r = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : {},
            s = arguments.length > 6 && void 0 !== arguments[6] ? arguments[6] : () => {};
          if (this.services.utils && this.services.utils.hasLoadedNamespace && !this.services.utils.hasLoadedNamespace(e)) this.logger.warn(`did not save key "${o}" as the namespace "${e}" was not yet loaded`, "This means something IS WRONG in your setup. You access the t function before i18next.init / i18next.loadNamespace / i18next.changeLanguage was done. Wait for the callback or Promise to resolve before accessing it!!!");
          else if (null != o && "" !== o) {
            if (this.backend && this.backend.create) {
              const a = {
                  ...r,
                  isUpdate: i
                },
                l = this.backend.create.bind(this.backend);
              if (l.length < 6) try {
                let i;
                i = 5 === l.length ? l(t, e, o, n, a) : l(t, e, o, n), i && "function" == typeof i.then ? i.then((t => s(null, t))).catch(s) : s(null, i)
              } catch (t) {
                s(t)
              } else l(t, e, o, n, s, a)
            }
            t && t[0] && this.store.addResource(t[0], e, o, n)
          }
        }
      }

      function D() {
        return {
          debug: !1,
          initImmediate: !0,
          ns: ["translation"],
          defaultNS: ["translation"],
          fallbackLng: ["dev"],
          fallbackNS: !1,
          supportedLngs: !1,
          nonExplicitSupportedLngs: !1,
          load: "all",
          preload: !1,
          simplifyPluralSuffix: !0,
          keySeparator: ".",
          nsSeparator: ":",
          pluralSeparator: "_",
          contextSeparator: "_",
          partialBundledLanguages: !1,
          saveMissing: !1,
          updateMissing: !1,
          saveMissingTo: "fallback",
          saveMissingPlurals: !0,
          missingKeyHandler: !1,
          missingInterpolationHandler: !1,
          postProcess: !1,
          postProcessPassResolved: !1,
          returnNull: !1,
          returnEmptyString: !0,
          returnObjects: !1,
          joinArrays: !1,
          returnedObjectHandler: !1,
          parseMissingKeyHandler: !1,
          appendNamespaceToMissingKey: !1,
          appendNamespaceToCIMode: !1,
          overloadTranslationOptionHandler: function(t) {
            let e = {};
            if ("object" == typeof t[1] && (e = t[1]), "string" == typeof t[1] && (e.defaultValue = t[1]), "string" == typeof t[2] && (e.tDescription = t[2]), "object" == typeof t[2] || "object" == typeof t[3]) {
              const o = t[3] || t[2];
              Object.keys(o).forEach((t => {
                e[t] = o[t]
              }))
            }
            return e
          },
          interpolation: {
            escapeValue: !0,
            format: t => t,
            prefix: "{{",
            suffix: "}}",
            formatSeparator: ",",
            unescapePrefix: "-",
            nestingPrefix: "$t(",
            nestingSuffix: ")",
            nestingOptionsSeparator: ",",
            maxReplaces: 1e3,
            skipOnVariables: !0
          }
        }
      }

      function I(t) {
        return "string" == typeof t.ns && (t.ns = [t.ns]), "string" == typeof t.fallbackLng && (t.fallbackLng = [t.fallbackLng]), "string" == typeof t.fallbackNS && (t.fallbackNS = [t.fallbackNS]), t.supportedLngs && t.supportedLngs.indexOf("cimode") < 0 && (t.supportedLngs = t.supportedLngs.concat(["cimode"])), t
      }

      function U() {}
      class F extends n {
        constructor() {
          let t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
            e = arguments.length > 1 ? arguments[1] : void 0;
          var n;
          if (super(), this.options = I(t), this.services = {}, this.logger = o, this.modules = {
              external: []
            }, n = this, Object.getOwnPropertyNames(Object.getPrototypeOf(n)).forEach((t => {
              "function" == typeof n[t] && (n[t] = n[t].bind(n))
            })), e && !this.isInitialized && !t.isClone) {
            if (!this.options.initImmediate) return this.init(t, e), this;
            setTimeout((() => {
              this.init(t, e)
            }), 0)
          }
        }
        init() {
          var t = this;
          let e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
            n = arguments.length > 1 ? arguments[1] : void 0;
          "function" == typeof e && (n = e, e = {}), !e.defaultNS && !1 !== e.defaultNS && e.ns && ("string" == typeof e.ns ? e.defaultNS = e.ns : e.ns.indexOf("translation") < 0 && (e.defaultNS = e.ns[0]));
          const i = D();

          function r(t) {
            return t ? "function" == typeof t ? new t : t : null
          }
          if (this.options = {
              ...i,
              ...this.options,
              ...I(e)
            }, "v1" !== this.options.compatibilityAPI && (this.options.interpolation = {
              ...i.interpolation,
              ...this.options.interpolation
            }), void 0 !== e.keySeparator && (this.options.userDefinedKeySeparator = e.keySeparator), void 0 !== e.nsSeparator && (this.options.userDefinedNsSeparator = e.nsSeparator), !this.options.isClone) {
            let e;
            this.modules.logger ? o.init(r(this.modules.logger), this.options) : o.init(null, this.options), this.modules.formatter ? e = this.modules.formatter : "undefined" != typeof Intl && (e = A);
            const n = new k(this.options);
            this.store = new v(this.options.resources, this.options);
            const s = this.services;
            s.logger = o, s.resourceStore = this.store, s.languageUtils = n, s.pluralResolver = new E(n, {
              prepend: this.options.pluralSeparator,
              compatibilityJSON: this.options.compatibilityJSON,
              simplifyPluralSuffix: this.options.simplifyPluralSuffix
            }), !e || this.options.interpolation.format && this.options.interpolation.format !== i.interpolation.format || (s.formatter = r(e), s.formatter.init(s, this.options), this.options.interpolation.format = s.formatter.format.bind(s.formatter)), s.interpolator = new N(this.options), s.utils = {
              hasLoadedNamespace: this.hasLoadedNamespace.bind(this)
            }, s.backendConnector = new $(r(this.modules.backend), s.resourceStore, s, this.options), s.backendConnector.on("*", (function(e) {
              for (var o = arguments.length, n = new Array(o > 1 ? o - 1 : 0), i = 1; i < o; i++) n[i - 1] = arguments[i];
              t.emit(e, ...n)
            })), this.modules.languageDetector && (s.languageDetector = r(this.modules.languageDetector), s.languageDetector.init && s.languageDetector.init(s, this.options.detection, this.options)), this.modules.i18nFormat && (s.i18nFormat = r(this.modules.i18nFormat), s.i18nFormat.init && s.i18nFormat.init(this)), this.translator = new x(this.services, this.options), this.translator.on("*", (function(e) {
              for (var o = arguments.length, n = new Array(o > 1 ? o - 1 : 0), i = 1; i < o; i++) n[i - 1] = arguments[i];
              t.emit(e, ...n)
            })), this.modules.external.forEach((t => {
              t.init && t.init(this)
            }))
          }
          if (this.format = this.options.interpolation.format, n || (n = U), this.options.fallbackLng && !this.services.languageDetector && !this.options.lng) {
            const t = this.services.languageUtils.getFallbackCodes(this.options.fallbackLng);
            t.length > 0 && "dev" !== t[0] && (this.options.lng = t[0])
          }
          this.services.languageDetector || this.options.lng || this.logger.warn("init: no languageDetector is used and no lng is defined"), ["getResource", "hasResourceBundle", "getResourceBundle", "getDataByLanguage"].forEach((e => {
            this[e] = function() {
              return t.store[e](...arguments)
            }
          })), ["addResource", "addResources", "addResourceBundle", "removeResourceBundle"].forEach((e => {
            this[e] = function() {
              return t.store[e](...arguments), t
            }
          }));
          const a = s(),
            l = () => {
              const t = (t, e) => {
                this.isInitialized && !this.initializedStoreOnce && this.logger.warn("init: i18next is already initialized. You should call init just once!"), this.isInitialized = !0, this.options.isClone || this.logger.log("initialized", this.options), this.emit("initialized", this.options), a.resolve(e), n(t, e)
              };
              if (this.languages && "v1" !== this.options.compatibilityAPI && !this.isInitialized) return t(null, this.t.bind(this));
              this.changeLanguage(this.options.lng, t)
            };
          return this.options.resources || !this.options.initImmediate ? l() : setTimeout(l, 0), a
        }
        loadResources(t) {
          let e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : U;
          const o = "string" == typeof t ? t : this.language;
          if ("function" == typeof t && (e = t), !this.options.resources || this.options.partialBundledLanguages) {
            if (o && "cimode" === o.toLowerCase() && (!this.options.preload || 0 === this.options.preload.length)) return e();
            const t = [],
              n = e => {
                e && "cimode" !== e && this.services.languageUtils.toResolveHierarchy(e).forEach((e => {
                  "cimode" !== e && t.indexOf(e) < 0 && t.push(e)
                }))
              };
            o ? n(o) : this.services.languageUtils.getFallbackCodes(this.options.fallbackLng).forEach((t => n(t))), this.options.preload && this.options.preload.forEach((t => n(t))), this.services.backendConnector.load(t, this.options.ns, (t => {
              t || this.resolvedLanguage || !this.language || this.setResolvedLanguage(this.language), e(t)
            }))
          } else e(null)
        }
        reloadResources(t, e, o) {
          const n = s();
          return t || (t = this.languages), e || (e = this.options.ns), o || (o = U), this.services.backendConnector.reload(t, e, (t => {
            n.resolve(), o(t)
          })), n
        }
        use(t) {
          if (!t) throw new Error("You are passing an undefined module! Please check the object you are passing to i18next.use()");
          if (!t.type) throw new Error("You are passing a wrong module! Please check the object you are passing to i18next.use()");
          return "backend" === t.type && (this.modules.backend = t), ("logger" === t.type || t.log && t.warn && t.error) && (this.modules.logger = t), "languageDetector" === t.type && (this.modules.languageDetector = t), "i18nFormat" === t.type && (this.modules.i18nFormat = t), "postProcessor" === t.type && b.addPostProcessor(t), "formatter" === t.type && (this.modules.formatter = t), "3rdParty" === t.type && this.modules.external.push(t), this
        }
        setResolvedLanguage(t) {
          if (t && this.languages && !(["cimode", "dev"].indexOf(t) > -1))
            for (let t = 0; t < this.languages.length; t++) {
              const e = this.languages[t];
              if (!(["cimode", "dev"].indexOf(e) > -1) && this.store.hasLanguageSomeTranslations(e)) {
                this.resolvedLanguage = e;
                break
              }
            }
        }
        changeLanguage(t, e) {
          var o = this;
          this.isLanguageChangingTo = t;
          const n = s();
          this.emit("languageChanging", t);
          const i = t => {
              this.language = t, this.languages = this.services.languageUtils.toResolveHierarchy(t), this.resolvedLanguage = void 0, this.setResolvedLanguage(t)
            },
            r = (t, r) => {
              r ? (i(r), this.translator.changeLanguage(r), this.isLanguageChangingTo = void 0, this.emit("languageChanged", r), this.logger.log("languageChanged", r)) : this.isLanguageChangingTo = void 0, n.resolve((function() {
                return o.t(...arguments)
              })), e && e(t, (function() {
                return o.t(...arguments)
              }))
            },
            a = e => {
              t || e || !this.services.languageDetector || (e = []);
              const o = "string" == typeof e ? e : this.services.languageUtils.getBestMatchFromCodes(e);
              o && (this.language || i(o), this.translator.language || this.translator.changeLanguage(o), this.services.languageDetector && this.services.languageDetector.cacheUserLanguage && this.services.languageDetector.cacheUserLanguage(o)), this.loadResources(o, (t => {
                r(t, o)
              }))
            };
          return t || !this.services.languageDetector || this.services.languageDetector.async ? !t && this.services.languageDetector && this.services.languageDetector.async ? 0 === this.services.languageDetector.detect.length ? this.services.languageDetector.detect().then(a) : this.services.languageDetector.detect(a) : a(t) : a(this.services.languageDetector.detect()), n
        }
        getFixedT(t, e, o) {
          var n = this;
          const i = function(t, e) {
            let r;
            if ("object" != typeof e) {
              for (var s = arguments.length, a = new Array(s > 2 ? s - 2 : 0), l = 2; l < s; l++) a[l - 2] = arguments[l];
              r = n.options.overloadTranslationOptionHandler([t, e].concat(a))
            } else r = {
              ...e
            };
            r.lng = r.lng || i.lng, r.lngs = r.lngs || i.lngs, r.ns = r.ns || i.ns, r.keyPrefix = r.keyPrefix || o || i.keyPrefix;
            const u = n.options.keySeparator || ".";
            let c;
            return c = r.keyPrefix && Array.isArray(t) ? t.map((t => `${r.keyPrefix}${u}${t}`)) : r.keyPrefix ? `${r.keyPrefix}${u}${t}` : t, n.t(c, r)
          };
          return "string" == typeof t ? i.lng = t : i.lngs = t, i.ns = e, i.keyPrefix = o, i
        }
        t() {
          return this.translator && this.translator.translate(...arguments)
        }
        exists() {
          return this.translator && this.translator.exists(...arguments)
        }
        setDefaultNamespace(t) {
          this.options.defaultNS = t
        }
        hasLoadedNamespace(t) {
          let e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
          if (!this.isInitialized) return this.logger.warn("hasLoadedNamespace: i18next was not initialized", this.languages), !1;
          if (!this.languages || !this.languages.length) return this.logger.warn("hasLoadedNamespace: i18n.languages were undefined or empty", this.languages), !1;
          const o = e.lng || this.resolvedLanguage || this.languages[0],
            n = !!this.options && this.options.fallbackLng,
            i = this.languages[this.languages.length - 1];
          if ("cimode" === o.toLowerCase()) return !0;
          const r = (t, e) => {
            const o = this.services.backendConnector.state[`${t}|${e}`];
            return -1 === o || 2 === o
          };
          if (e.precheck) {
            const t = e.precheck(this, r);
            if (void 0 !== t) return t
          }
          return !(!this.hasResourceBundle(o, t) && this.services.backendConnector.backend && (!this.options.resources || this.options.partialBundledLanguages) && (!r(o, t) || n && !r(i, t)))
        }
        loadNamespaces(t, e) {
          const o = s();
          return this.options.ns ? ("string" == typeof t && (t = [t]), t.forEach((t => {
            this.options.ns.indexOf(t) < 0 && this.options.ns.push(t)
          })), this.loadResources((t => {
            o.resolve(), e && e(t)
          })), o) : (e && e(), Promise.resolve())
        }
        loadLanguages(t, e) {
          const o = s();
          "string" == typeof t && (t = [t]);
          const n = this.options.preload || [],
            i = t.filter((t => n.indexOf(t) < 0));
          return i.length ? (this.options.preload = n.concat(i), this.loadResources((t => {
            o.resolve(), e && e(t)
          })), o) : (e && e(), Promise.resolve())
        }
        dir(t) {
          if (t || (t = this.resolvedLanguage || (this.languages && this.languages.length > 0 ? this.languages[0] : this.language)), !t) return "rtl";
          const e = this.services && this.services.languageUtils || new k(D());
          return ["ar", "shu", "sqr", "ssh", "xaa", "yhd", "yud", "aao", "abh", "abv", "acm", "acq", "acw", "acx", "acy", "adf", "ads", "aeb", "aec", "afb", "ajp", "apc", "apd", "arb", "arq", "ars", "ary", "arz", "auz", "avl", "ayh", "ayl", "ayn", "ayp", "bbz", "pga", "he", "iw", "ps", "pbt", "pbu", "pst", "prp", "prd", "ug", "ur", "ydd", "yds", "yih", "ji", "yi", "hbo", "men", "xmn", "fa", "jpr", "peo", "pes", "prs", "dv", "sam", "ckb"].indexOf(e.getLanguagePartFromCode(t)) > -1 || t.toLowerCase().indexOf("-arab") > 1 ? "rtl" : "ltr"
        }
        static createInstance() {
          return new F(arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {}, arguments.length > 1 ? arguments[1] : void 0)
        }
        cloneInstance() {
          let t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
            e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : U;
          const o = t.forkResourceStore;
          o && delete t.forkResourceStore;
          const n = {
              ...this.options,
              ...t,
              isClone: !0
            },
            i = new F(n);
          return void 0 === t.debug && void 0 === t.prefix || (i.logger = i.logger.clone(t)), ["store", "services", "language"].forEach((t => {
            i[t] = this[t]
          })), i.services = {
            ...this.services
          }, i.services.utils = {
            hasLoadedNamespace: i.hasLoadedNamespace.bind(i)
          }, o && (i.store = new v(this.store.data, n), i.services.resourceStore = i.store), i.translator = new x(i.services, n), i.translator.on("*", (function(t) {
            for (var e = arguments.length, o = new Array(e > 1 ? e - 1 : 0), n = 1; n < e; n++) o[n - 1] = arguments[n];
            i.emit(t, ...o)
          })), i.init(n, e), i.translator.options = n, i.translator.backendConnector.services.utils = {
            hasLoadedNamespace: i.hasLoadedNamespace.bind(i)
          }, i
        }
        toJSON() {
          return {
            options: this.options,
            store: this.store,
            language: this.language,
            languages: this.languages,
            resolvedLanguage: this.resolvedLanguage
          }
        }
      }
      const _ = F.createInstance();

      function B(t) {
        return B = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
          return typeof t
        } : function(t) {
          return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
        }, B(t)
      }
      _.createInstance = F.createInstance, _.createInstance, _.dir, _.init, _.loadResources, _.reloadResources, _.use, _.changeLanguage, _.getFixedT, _.t, _.exists, _.setDefaultNamespace, _.hasLoadedNamespace, _.loadNamespaces, _.loadLanguages;
      var M = [],
        H = M.forEach,
        V = M.slice;

      function q(t) {
        return H.call(V.call(arguments, 1), (function(e) {
          if (e)
            for (var o in e) void 0 === t[o] && (t[o] = e[o])
        })), t
      }

      function K() {
        return "function" == typeof XMLHttpRequest || "object" === ("undefined" == typeof XMLHttpRequest ? "undefined" : B(XMLHttpRequest))
      }
      var z, J, X, G = i(3154),
        W = i.t(G, 2);

      function Y(t) {
        return Y = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
          return typeof t
        } : function(t) {
          return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
        }, Y(t)
      }
      "function" == typeof fetch && (z = "undefined" != typeof global && global.fetch ? global.fetch : "undefined" != typeof window && window.fetch ? window.fetch : fetch), K() && ("undefined" != typeof global && global.XMLHttpRequest ? J = global.XMLHttpRequest : "undefined" != typeof window && window.XMLHttpRequest && (J = window.XMLHttpRequest)), "function" == typeof ActiveXObject && ("undefined" != typeof global && global.ActiveXObject ? X = global.ActiveXObject : "undefined" != typeof window && window.ActiveXObject && (X = window.ActiveXObject)), z || !W || J || X || (z = G || W), "function" != typeof z && (z = void 0);
      var Q = function(t, e) {
          if (e && "object" === Y(e)) {
            var o = "";
            for (var n in e) o += "&" + encodeURIComponent(n) + "=" + encodeURIComponent(e[n]);
            if (!o) return t;
            t = t + (-1 !== t.indexOf("?") ? "&" : "?") + o.slice(1)
          }
          return t
        },
        Z = function(t, e, o) {
          var n = function(t) {
            if (!t.ok) return o(t.statusText || "Error", {
              status: t.status
            });
            t.text().then((function(e) {
              o(null, {
                status: t.status,
                data: e
              })
            })).catch(o)
          };
          "function" == typeof fetch ? fetch(t, e).then(n).catch(o) : z(t, e).then(n).catch(o)
        },
        tt = !1,
        et = function(t, e, o, n) {
          return "function" == typeof o && (n = o, o = void 0), n = n || function() {}, z && 0 !== e.indexOf("file:") ? function(t, e, o, n) {
            t.queryStringParams && (e = Q(e, t.queryStringParams));
            var i = q({}, "function" == typeof t.customHeaders ? t.customHeaders() : t.customHeaders);
            "undefined" == typeof window && "undefined" != typeof global && void 0 !== global.process && global.process.versions && global.process.versions.node && (i["User-Agent"] = "i18next-http-backend (node/".concat(global.process.version, "; ").concat(global.process.platform, " ").concat(global.process.arch, ")")), o && (i["Content-Type"] = "application/json");
            var r = "function" == typeof t.requestOptions ? t.requestOptions(o) : t.requestOptions,
              s = q({
                method: o ? "POST" : "GET",
                body: o ? t.stringify(o) : void 0,
                headers: i
              }, tt ? {} : r);
            try {
              Z(e, s, n)
            } catch (t) {
              if (!r || 0 === Object.keys(r).length || !t.message || t.message.indexOf("not implemented") < 0) return n(t);
              try {
                Object.keys(r).forEach((function(t) {
                  delete s[t]
                })), Z(e, s, n), tt = !0
              } catch (t) {
                n(t)
              }
            }
          }(t, e, o, n) : K() || "function" == typeof ActiveXObject ? function(t, e, o, n) {
            o && "object" === Y(o) && (o = Q("", o).slice(1)), t.queryStringParams && (e = Q(e, t.queryStringParams));
            try {
              var i;
              (i = J ? new J : new X("MSXML2.XMLHTTP.3.0")).open(o ? "POST" : "GET", e, 1), t.crossDomain || i.setRequestHeader("X-Requested-With", "XMLHttpRequest"), i.withCredentials = !!t.withCredentials, o && i.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), i.overrideMimeType && i.overrideMimeType("application/json");
              var r = t.customHeaders;
              if (r = "function" == typeof r ? r() : r)
                for (var s in r) i.setRequestHeader(s, r[s]);
              i.onreadystatechange = function() {
                i.readyState > 3 && n(i.status >= 400 ? i.statusText : null, {
                  status: i.status,
                  data: i.responseText
                })
              }, i.send(o)
            } catch (t) {
              console && console.log(t)
            }
          }(t, e, o, n) : void n(new Error("No fetch and no xhr implementation found!"))
        };

      function ot(t) {
        return ot = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
          return typeof t
        } : function(t) {
          return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
        }, ot(t)
      }

      function nt(t, e) {
        for (var o = 0; o < e.length; o++) {
          var n = e[o];
          n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, it(n.key), n)
        }
      }

      function it(t) {
        var e = function(t, e) {
          if ("object" !== ot(t) || null === t) return t;
          var o = t[Symbol.toPrimitive];
          if (void 0 !== o) {
            var n = o.call(t, "string");
            if ("object" !== ot(n)) return n;
            throw new TypeError("@@toPrimitive must return a primitive value.")
          }
          return String(t)
        }(t);
        return "symbol" === ot(e) ? e : String(e)
      }
      var rt = function() {
        function t(e) {
          var o = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
            n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
          ! function(t, e) {
            if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
          }(this, t), this.services = e, this.options = o, this.allOptions = n, this.type = "backend", this.init(e, o, n)
        }
        var e, o;
        return e = t, o = [{
          key: "init",
          value: function(t) {
            var e = this,
              o = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
              n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
            this.services = t, this.options = q(o, this.options || {}, {
              loadPath: "/locales/{{lng}}/{{ns}}.json",
              addPath: "/locales/add/{{lng}}/{{ns}}",
              parse: function(t) {
                return JSON.parse(t)
              },
              stringify: JSON.stringify,
              parsePayload: function(t, e, o) {
                return function(t, e, o) {
                  return (e = it(e)) in t ? Object.defineProperty(t, e, {
                    value: o,
                    enumerable: !0,
                    configurable: !0,
                    writable: !0
                  }) : t[e] = o, t
                }({}, e, o || "")
              },
              parseLoadPayload: function(t, e) {},
              request: et,
              reloadInterval: "undefined" == typeof window && 36e5,
              customHeaders: {},
              queryStringParams: {},
              crossDomain: !1,
              withCredentials: !1,
              overrideMimeType: !1,
              requestOptions: {
                mode: "cors",
                credentials: "same-origin",
                cache: "default"
              }
            }), this.allOptions = n, this.services && this.options.reloadInterval && setInterval((function() {
              return e.reload()
            }), this.options.reloadInterval)
          }
        }, {
          key: "readMulti",
          value: function(t, e, o) {
            this._readAny(t, t, e, e, o)
          }
        }, {
          key: "read",
          value: function(t, e, o) {
            this._readAny([t], t, [e], e, o)
          }
        }, {
          key: "_readAny",
          value: function(t, e, o, n, i) {
            var r, s = this,
              a = this.options.loadPath;
            "function" == typeof this.options.loadPath && (a = this.options.loadPath(t, o)), (a = function(t) {
              return !!t && "function" == typeof t.then
            }(r = a) ? r : Promise.resolve(r)).then((function(r) {
              if (!r) return i(null, {});
              var a = s.services.interpolator.interpolate(r, {
                lng: t.join("+"),
                ns: o.join("+")
              });
              s.loadUrl(a, i, e, n)
            }))
          }
        }, {
          key: "loadUrl",
          value: function(t, e, o, n) {
            var i = this,
              r = "string" == typeof o ? [o] : o,
              s = "string" == typeof n ? [n] : n,
              a = this.options.parseLoadPayload(r, s);
            this.options.request(this.options, t, a, (function(r, s) {
              if (s && (s.status >= 500 && s.status < 600 || !s.status)) return e("failed loading " + t + "; status code: " + s.status, !0);
              if (s && s.status >= 400 && s.status < 500) return e("failed loading " + t + "; status code: " + s.status, !1);
              if (!s && r && r.message && r.message.indexOf("Failed to fetch") > -1) return e("failed loading " + t + ": " + r.message, !0);
              if (r) return e(r, !1);
              var a, l;
              try {
                a = "string" == typeof s.data ? i.options.parse(s.data, o, n) : s.data
              } catch (e) {
                l = "failed parsing " + t + " to json"
              }
              if (l) return e(l, !1);
              e(null, a)
            }))
          }
        }, {
          key: "create",
          value: function(t, e, o, n, i) {
            var r = this;
            if (this.options.addPath) {
              "string" == typeof t && (t = [t]);
              var s = this.options.parsePayload(e, o, n),
                a = 0,
                l = [],
                u = [];
              t.forEach((function(o) {
                var n = r.options.addPath;
                "function" == typeof r.options.addPath && (n = r.options.addPath(o, e));
                var c = r.services.interpolator.interpolate(n, {
                  lng: o,
                  ns: e
                });
                r.options.request(r.options, c, s, (function(e, o) {
                  a += 1, l.push(e), u.push(o), a === t.length && "function" == typeof i && i(l, u)
                }))
              }))
            }
          }
        }, {
          key: "reload",
          value: function() {
            var t = this,
              e = this.services,
              o = e.backendConnector,
              n = e.languageUtils,
              i = e.logger,
              r = o.language;
            if (!r || "cimode" !== r.toLowerCase()) {
              var s = [],
                a = function(t) {
                  n.toResolveHierarchy(t).forEach((function(t) {
                    s.indexOf(t) < 0 && s.push(t)
                  }))
                };
              a(r), this.allOptions.preload && this.allOptions.preload.forEach((function(t) {
                return a(t)
              })), s.forEach((function(e) {
                t.allOptions.ns.forEach((function(t) {
                  o.read(e, t, "read", null, null, (function(n, r) {
                    n && i.warn("loading namespace ".concat(t, " for language ").concat(e, " failed"), n), !n && r && i.log("loaded namespace ".concat(t, " for language ").concat(e), r), o.loaded("".concat(e, "|").concat(t), n, r)
                  }))
                }))
              }))
            }
          }
        }], o && nt(e.prototype, o), Object.defineProperty(e, "prototype", {
          writable: !1
        }), t
      }();
      rt.type = "backend";
      var st = rt;

      function at(t) {
        return at = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
          return typeof t
        } : function(t) {
          return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
        }, at(t)
      }

      function lt(t) {
        var e = function(t, e) {
          if ("object" != at(t) || !t) return t;
          var o = t[Symbol.toPrimitive];
          if (void 0 !== o) {
            var n = o.call(t, "string");
            if ("object" != at(n)) return n;
            throw new TypeError("@@toPrimitive must return a primitive value.")
          }
          return String(t)
        }(t);
        return "symbol" == at(e) ? e : String(e)
      }

      function ut(t, e) {
        for (var o = 0; o < e.length; o++) {
          var n = e[o];
          n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, lt(n.key), n)
        }
      }
      var ct = [],
        ht = ct.forEach,
        pt = ct.slice,
        ft = /^[\u0009\u0020-\u007e\u0080-\u00ff]+$/,
        dt = {
          name: "cookie",
          lookup: function(t) {
            var e;
            if (t.lookupCookie && "undefined" != typeof document) {
              var o = function(t) {
                for (var e = "".concat(t, "="), o = document.cookie.split(";"), n = 0; n < o.length; n++) {
                  for (var i = o[n];
                    " " === i.charAt(0);) i = i.substring(1, i.length);
                  if (0 === i.indexOf(e)) return i.substring(e.length, i.length)
                }
                return null
              }(t.lookupCookie);
              o && (e = o)
            }
            return e
          },
          cacheUserLanguage: function(t, e) {
            e.lookupCookie && "undefined" != typeof document && function(t, e, o, n) {
              var i = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : {
                path: "/",
                sameSite: "strict"
              };
              o && (i.expires = new Date, i.expires.setTime(i.expires.getTime() + 60 * o * 1e3)), n && (i.domain = n), document.cookie = function(t, e, o) {
                var n = o || {};
                n.path = n.path || "/";
                var i = encodeURIComponent(e),
                  r = "".concat(t, "=").concat(i);
                if (n.maxAge > 0) {
                  var s = n.maxAge - 0;
                  if (Number.isNaN(s)) throw new Error("maxAge should be a Number");
                  r += "; Max-Age=".concat(Math.floor(s))
                }
                if (n.domain) {
                  if (!ft.test(n.domain)) throw new TypeError("option domain is invalid");
                  r += "; Domain=".concat(n.domain)
                }
                if (n.path) {
                  if (!ft.test(n.path)) throw new TypeError("option path is invalid");
                  r += "; Path=".concat(n.path)
                }
                if (n.expires) {
                  if ("function" != typeof n.expires.toUTCString) throw new TypeError("option expires is invalid");
                  r += "; Expires=".concat(n.expires.toUTCString())
                }
                if (n.httpOnly && (r += "; HttpOnly"), n.secure && (r += "; Secure"), n.sameSite) switch ("string" == typeof n.sameSite ? n.sameSite.toLowerCase() : n.sameSite) {
                  case !0:
                    r += "; SameSite=Strict";
                    break;
                  case "lax":
                    r += "; SameSite=Lax";
                    break;
                  case "strict":
                    r += "; SameSite=Strict";
                    break;
                  case "none":
                    r += "; SameSite=None";
                    break;
                  default:
                    throw new TypeError("option sameSite is invalid")
                }
                return r
              }(t, encodeURIComponent(e), i)
            }(e.lookupCookie, t, e.cookieMinutes, e.cookieDomain, e.cookieOptions)
          }
        },
        gt = {
          name: "querystring",
          lookup: function(t) {
            var e;
            if ("undefined" != typeof window) {
              var o = window.location.search;
              !window.location.search && window.location.hash && window.location.hash.indexOf("?") > -1 && (o = window.location.hash.substring(window.location.hash.indexOf("?")));
              for (var n = o.substring(1).split("&"), i = 0; i < n.length; i++) {
                var r = n[i].indexOf("=");
                r > 0 && n[i].substring(0, r) === t.lookupQuerystring && (e = n[i].substring(r + 1))
              }
            }
            return e
          }
        },
        yt = null,
        mt = function() {
          if (null !== yt) return yt;
          try {
            yt = "undefined" !== window && null !== window.localStorage;
            var t = "i18next.translate.boo";
            window.localStorage.setItem(t, "foo"), window.localStorage.removeItem(t)
          } catch (t) {
            yt = !1
          }
          return yt
        },
        vt = {
          name: "localStorage",
          lookup: function(t) {
            var e;
            if (t.lookupLocalStorage && mt()) {
              var o = window.localStorage.getItem(t.lookupLocalStorage);
              o && (e = o)
            }
            return e
          },
          cacheUserLanguage: function(t, e) {
            e.lookupLocalStorage && mt() && window.localStorage.setItem(e.lookupLocalStorage, t)
          }
        },
        bt = null,
        wt = function() {
          if (null !== bt) return bt;
          try {
            bt = "undefined" !== window && null !== window.sessionStorage;
            var t = "i18next.translate.boo";
            window.sessionStorage.setItem(t, "foo"), window.sessionStorage.removeItem(t)
          } catch (t) {
            bt = !1
          }
          return bt
        },
        xt = {
          name: "sessionStorage",
          lookup: function(t) {
            var e;
            if (t.lookupSessionStorage && wt()) {
              var o = window.sessionStorage.getItem(t.lookupSessionStorage);
              o && (e = o)
            }
            return e
          },
          cacheUserLanguage: function(t, e) {
            e.lookupSessionStorage && wt() && window.sessionStorage.setItem(e.lookupSessionStorage, t)
          }
        },
        St = {
          name: "navigator",
          lookup: function(t) {
            var e = [];
            if ("undefined" != typeof navigator) {
              if (navigator.languages)
                for (var o = 0; o < navigator.languages.length; o++) e.push(navigator.languages[o]);
              navigator.userLanguage && e.push(navigator.userLanguage), navigator.language && e.push(navigator.language)
            }
            return e.length > 0 ? e : void 0
          }
        },
        kt = {
          name: "htmlTag",
          lookup: function(t) {
            var e, o = t.htmlTag || ("undefined" != typeof document ? document.documentElement : null);
            return o && "function" == typeof o.getAttribute && (e = o.getAttribute("lang")), e
          }
        },
        Ot = {
          name: "path",
          lookup: function(t) {
            var e;
            if ("undefined" != typeof window) {
              var o = window.location.pathname.match(/\/([a-zA-Z-]*)/g);
              if (o instanceof Array)
                if ("number" == typeof t.lookupFromPathIndex) {
                  if ("string" != typeof o[t.lookupFromPathIndex]) return;
                  e = o[t.lookupFromPathIndex].replace("/", "")
                } else e = o[0].replace("/", "")
            }
            return e
          }
        },
        Lt = {
          name: "subdomain",
          lookup: function(t) {
            var e = "number" == typeof t.lookupFromSubdomainIndex ? t.lookupFromSubdomainIndex + 1 : 1,
              o = "undefined" != typeof window && window.location && window.location.hostname && window.location.hostname.match(/^(\w{2,5})\.(([a-z0-9-]{1,63}\.[a-z]{2,6})|localhost)/i);
            if (o) return o[e]
          }
        },
        Pt = function() {
          function t(e) {
            var o = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
            ! function(t, e) {
              if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, t), this.type = "languageDetector", this.detectors = {}, this.init(e, o)
          }
          var e, o;
          return e = t, o = [{
            key: "init",
            value: function(t) {
              var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                o = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
              this.services = t || {
                languageUtils: {}
              }, this.options = function(t) {
                return ht.call(pt.call(arguments, 1), (function(e) {
                  if (e)
                    for (var o in e) void 0 === t[o] && (t[o] = e[o])
                })), t
              }(e, this.options || {}, {
                order: ["querystring", "cookie", "localStorage", "sessionStorage", "navigator", "htmlTag"],
                lookupQuerystring: "lng",
                lookupCookie: "i18next",
                lookupLocalStorage: "i18nextLng",
                lookupSessionStorage: "i18nextLng",
                caches: ["localStorage"],
                excludeCacheFor: ["cimode"],
                convertDetectedLanguage: function(t) {
                  return t
                }
              }), "string" == typeof this.options.convertDetectedLanguage && this.options.convertDetectedLanguage.indexOf("15897") > -1 && (this.options.convertDetectedLanguage = function(t) {
                return t.replace("-", "_")
              }), this.options.lookupFromUrlIndex && (this.options.lookupFromPathIndex = this.options.lookupFromUrlIndex), this.i18nOptions = o, this.addDetector(dt), this.addDetector(gt), this.addDetector(vt), this.addDetector(xt), this.addDetector(St), this.addDetector(kt), this.addDetector(Ot), this.addDetector(Lt)
            }
          }, {
            key: "addDetector",
            value: function(t) {
              this.detectors[t.name] = t
            }
          }, {
            key: "detect",
            value: function(t) {
              var e = this;
              t || (t = this.options.order);
              var o = [];
              return t.forEach((function(t) {
                if (e.detectors[t]) {
                  var n = e.detectors[t].lookup(e.options);
                  n && "string" == typeof n && (n = [n]), n && (o = o.concat(n))
                }
              })), o = o.map((function(t) {
                return e.options.convertDetectedLanguage(t)
              })), this.services.languageUtils.getBestMatchFromCodes ? o : o.length > 0 ? o[0] : null
            }
          }, {
            key: "cacheUserLanguage",
            value: function(t, e) {
              var o = this;
              e || (e = this.options.caches), e && (this.options.excludeCacheFor && this.options.excludeCacheFor.indexOf(t) > -1 || e.forEach((function(e) {
                o.detectors[e] && o.detectors[e].cacheUserLanguage(t, o.options)
              })))
            }
          }], o && ut(e.prototype, o), Object.defineProperty(e, "prototype", {
            writable: !1
          }), t
        }();
      Pt.type = "languageDetector"
    }(), r
  }()
}));