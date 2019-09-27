webpackJsonp([5], {
    0: function (e, n, t) {
        t("4t5a"), t("Z3mU"), t("PWuC"), t("Ky+F"), t("byej"), t("ufoq"), t("nTfl"), t("Y2EE"), t("viqD"), t("WHGz"), t("rqKu"), t("ZN9n"), t("lFvb"), t("QGAl"), t("V0Fp"), t("qJ1m"), e.exports = t("d0W6")
    }, "4t5a": function (e, n, t) {
        "use strict";
        Object.defineProperty(n, "__esModule", {value: !0});
        var i = t("mtWM"), s = t.n(i), a = t("HNiq"),
            o = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
                return typeof e
            } : function (e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            };
        window.game_slots_reel = function (e, n, t) {
            var i = this;
            return this.idx = e, this.self = this, this.ids = n, this.game = t, this.speed_frame = 0, this.animation_frame = 0, this.speed = 0, this.speed_max = t.speed_max, this.delta = 0, this.delta_stop = 0, this.stop_to = 0, this.position = 0, this.t = Date.now(), this.is_spin = !1, this.is_stopping = !1, this.is_spinning = !1, this.delta_pos_stop = 4, this.delta_stop_max = 200 * this.delta_pos_stop, this.syms_win = [], this.startSpin = function () {
                i.is_spin = !0, i.is_stopping = !1, i.is_spinning = !0
            }, this.stopSpin = function (e) {
                void 0 === e && (e = 0), i.stop_to = e, i.is_spin = !1
            }, this.onspinned = null, this.onstopped = null, this.win = function (e) {
                i.syms_win = e
            }, this.win_add = function (e) {
                i.syms_win.push(e)
            }, this.win_clear = function () {
                i.syms_win = []
            }, this.getReelPosition = function (e) {
                return e < 0 ? i.getReelPosition(i.ids.length + e) : e >= i.ids.length ? i.getReelPosition(e - i.ids.length) : e
            }, this.draw = function () {
                var e = i.game.canvas.getContext("2d"), n = 0, t = 0;
                if (i.speed > 0) {
                    for (; 100 + 200 * -n + Math.round(.5 * i.game.sym[i.ids[i.getReelPosition(i.position - 1 - n)]].speed_frames[i.speed_frame].height) + i.delta > 0;) n++;
                    for (; 100 + 200 * t - Math.round(.5 * i.game.sym[i.ids[i.getReelPosition(i.position - 1 - n)]].speed_frames[i.speed_frame].height) + i.delta < i.game.canvas.height;) t++
                }
                for (var s = null, a = -n; a < 3 + t; a++) (s = 0 == i.speed && -1 != i.syms_win.indexOf(i.getReelPosition(i.position + a)) ? null : i.game.sym[i.ids[i.getReelPosition(i.position + a)]].speed_frames[i.speed_frame]) && e.drawImage(s, 245 + 228 * i.idx - Math.round(.5 * s.width), 100 + 200 * a - Math.round(.5 * s.height) + i.delta);
                if (i.speed > 0) {
                    e.strokeStyle = "white", e.lineWidth = 5, e.shadowOffsetX = 0, e.shadowOffsetY = 10, e.shadowColor = "white", e.lineCap = "round";
                    var o = [5, 15, 30], l = 1 - Math.abs((2 * i.delta - 200) / 200);
                    for (var a in i.speed < i.speed_max / 2 ? e.globalAlpha = l : e.globalAlpha = (2 - l) / 2, o) e.shadowBlur = o[a], e.beginPath(), e.moveTo(145 + 228 * i.idx + (100 - 100 * l), -10), e.lineTo(145 + 228 * i.idx + 200 - (100 - 100 * l), -10), e.stroke();
                    for (var a in e.shadowOffsetY = -10, o) e.shadowBlur = o[a], e.beginPath(), e.moveTo(145 + 228 * i.idx + (100 - 100 * l), i.game.canvas.height + 10), e.lineTo(145 + 228 * i.idx + 200 - (100 - 100 * l), i.game.canvas.height + 10), e.stroke();
                    e.globalAlpha = 1, e.strokeStyle = "white", e.lineWidth = 0, e.shadowOffsetX = 0, e.shadowOffsetY = 0, e.shadowBlur = 0, e.shadowColor = "white", e.lineCap = "round"
                }
            }, this.drawWin = function () {
                if (!(i.speed > 0)) for (var e = i.game.canvas.getContext("2d"), n = null, t = 0; t < 3; t++) 0 == i.speed && -1 != i.syms_win.indexOf(i.getReelPosition(i.position + t)) && (n = i.game.sym[i.ids[i.getReelPosition(i.position + t)]].animation[Math.round(i.animation_frame)]) && e.drawImage(n, 245 + 228 * i.idx - Math.round(.5 * n.width), 100 + 200 * t - Math.round(.5 * n.height) + i.delta)
            }, this.calculate = function () {
                for (i.delta += Math.round((i.game.t - i.t) * i.speed * 5e-4), i.is_spin || (i.delta_stop -= Math.round((i.game.t - i.t) * i.speed * 5e-4), i.delta_stop < 0 && (i.delta_stop = 0)); i.delta >= 200;) i.delta -= 200, i.position = i.getReelPosition(i.position - 1), i.is_spin || i.is_stopping || i.getReelPosition(i.position - i.delta_pos_stop) != i.stop_to || (i.is_stopping = !0, i.delta_stop = i.delta_stop_max - i.delta);
                for (; i.delta <= -200;) i.delta += 200, i.position = i.getReelPosition(i.position + 1);
                if (i.is_spin && i.speed < i.speed_max && (i.speed += Math.round(1e4 * (i.game.t - i.t) * 5e-4), i.speed > i.speed_max && (i.speed = i.speed_max), i.speed_frame = Math.round(i.speed / 1e3 * 2), i.speed_frame < 0 && (i.speed_frame = 0), i.speed_frame > Math.round(i.speed_max / 1e3 * 2) && (i.speed_frame = Math.round(i.speed_max / 1e3 * 2)), i.speed < i.speed_max || "function" != typeof i.onspinned || i.onspinned(i)), !i.is_spin && i.is_stopping && i.speed > 0) {
                    var e = Math.round(Math.pow(i.delta_stop / i.delta_stop_max, .5) * i.speed_max);
                    e < i.speed && (i.speed = e), Math.round(5e3 * (i.game.t - i.t) * 5e-4), i.speed < 0 && (i.speed = 0), 0 == i.speed && (i.is_spinning = !1, i.is_stopping = !1, i.delta = 0, "function" == typeof i.onstopped && i.onstopped(i)), i.speed_frame = Math.round(i.speed / 1e3 * 2), i.speed_frame < 0 && (i.speed_frame = 0), i.speed_frame > Math.round(i.speed_max / 1e3 * 2) && (i.speed_frame = Math.round(i.speed_max / 1e3 * 2))
                }
                if (0 == i.speed && i.syms_win.length > 0) for (i.animation_frame += .03 * (i.game.t - i.t); Math.round(i.animation_frame) >= i.game.animation_time;) i.animation_frame -= i.game.animation_time;
                i.t = i.game.t
            }, this
        }, window.game_slots_line = function (e, n) {
            var t = this;
            return this.self = this, this.data = e, this.game = n, this.alpha = 0, this.shown_p = 0, this.t = Date.now(), this.display = !1, this.show = function () {
                t.display = !0
            }, this.hide = function () {
                t.display = !1
            }, this.draw = function () {
                if (0 != t.shown_p) {
                    var e = t.game.canvas.getContext("2d");
                    e.strokeStyle = "white", e.lineWidth = 4, e.shadowOffsetX = 0, e.shadowOffsetY = 0, e.shadowColor = "white", e.lineCap = "round", e.globalAlpha = t.alpha;
                    var n = [5 * t.alpha, 15 * t.alpha, 30 * t.alpha, 60 * t.alpha, 100 * t.alpha];
                    for (var i in n) {
                        for (var i in e.shadowBlur = n[i], e.beginPath(), e.moveTo(95, 100 + 200 * t.data[0]), t.data) e.lineTo(245 + 228 * i, 100 + 200 * t.data[i]);
                        e.lineTo(245 + 228 * i + 150, 100 + 200 * t.data[i]), e.stroke()
                    }
                    e.globalAlpha = 1, e.strokeStyle = "white", e.lineWidth = 0, e.shadowOffsetX = 0, e.shadowOffsetY = 0, e.shadowBlur = 0, e.shadowColor = "white", e.lineCap = "round"
                }
            }, this.calculate = function () {
                t.display && t.shown_p < 1 && (t.shown_p += (t.game.t - t.t) / 300, t.shown_p > 1 && (t.shown_p = 1), t.alpha = t.shown_p), !t.display && t.shown_p > 0 && (t.shown_p -= (t.game.t - t.t) / 100, t.shown_p < 0 && (t.shown_p = 0), t.alpha = t.shown_p), t.display || 0 != t.shown_p || 0 == t.alpha || (t.alpha = 1), t.t = t.game.t
            }, this
        }, window.game_slots_sound = function (e, n) {
            var t = this;
            this.id = e, this.file = e, this.is_loop = !1, this.volume = 1, this.onload = n, this.play = function () {
                var e = (new createjs.PlayPropsConfig).set({
                    interrupt: createjs.Sound.INTERRUPT_ANY,
                    loop: t.is_loop ? -1 : 0,
                    volume: t.volume
                });
                createjs.Sound.play(t.id, e)
            }, this.stop = function () {
                createjs.Sound.stop(t.id)
            }, this.onfileload = function (e) {
                "function" == typeof t.onload && t.onload()
            };
            var i = new createjs.LoadQueue;
            return createjs.Sound.alternateExtensions = ["mp3"], i.installPlugin(createjs.Sound), i.addEventListener("complete", t.onfileload), i.loadManifest([{
                id: t.id,
                src: t.file
            }]), this
        }, window.game_slots_proto = function (e) {
            var n = {
                s: 0,
                c: 0,
                fps: 0,
                is_render_planned: !1,
                is_sound: !0,
                game_id: 0,
                balance_warn_text: "",
                balance: 0,
                lines_count: 0,
                bet: 0,
                query_data: "",
                is_show_demo: !1,
                t_show_demo: 0,
                is_line_showig: !1,
                win: {},
                win_scatter: [],
                win_label: {},
                win_loop: [],
                container: null,
                container_inner: null,
                canvas: null,
                container_bg: null,
                label_win: null,
                label_balance: null,
                label_bet: null,
                label_lines: null,
                btns_line: {},
                btn_spin: null,
                btn_bet_max: null,
                btn_bet_minus: null,
                btn_bet_plus: null,
                btn_line_minus: null,
                btn_line_plus: null,
                btn_sound: null,
                btn_paytable: null,
                lines_show_demo: -1,
                view_preloader: null,
                label_preloader_percent: null,
                lines: [],
                reels: null,
                sym: [],
                theme: Object(a.b)("settings.theme"),
                loading_cnt: 0,
                loading_idx: 0,
                speed_max: 5e3,
                animation_time: 28,
                snd_click: null,
                snd_lose: null,
                snd_spin: null,
                snd_start: null,
                snd_stop: null,
                snd_win: null,
                game_result: null,
                sym_size: 200,
                t: 0,
                t_drawed: 0,
                t_hide: 0,
                requestAnimationFrame: function (e) {
                    setTimeout(e, 1)
                },
                requestAnimationFrame_get: function () {
                    var e = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || window.oRequestAnimationFrame;
                    n.requestAnimationFrame = e ? e.bind(window) : null
                },
                domInit: function () {
                    if (n.container = window.document.getElementById("game_slots_container"), !n.container) return !1;
                    n.game_slots_paytable_data = window.document.getElementById("game_slots_paytable_data"), n.label_win = window.document.getElementById("game_slots_win_line"), n.label_win_total = window.document.getElementById("game_slots_total_win_label"), n.container_bg = window.document.getElementById("game_slots_bg"), n.container_inner = n.container.getElementsByClassName("inner")[0], n.canvas = window.document.getElementById("game_slots_drawable"), n.label_balance = window.document.getElementById("game_slots_balance"), n.label_bet = window.document.getElementById("game_slots_bet"), n.label_lines = window.document.getElementById("game_slots_lines"), n.btn_spin = window.document.getElementById("game_slots_btn_spin"), n.btn_bet_max = window.document.getElementById("game_slots_btn_bet_max"), n.btn_bet_minus = window.document.getElementById("game_slots_btn_bet_minus"), n.btn_bet_plus = window.document.getElementById("game_slots_btn_bet_plus"), n.btn_line_minus = window.document.getElementById("game_slots_btn_lines_minus"), n.btn_line_plus = window.document.getElementById("game_slots_btn_lines_plus"), n.btn_sound = window.document.getElementById("game_slots_btn_sound"), n.btn_paytable = window.document.getElementById("game_slots_btn_paytable"), n.server_hash = window.document.getElementById("server-hash-input"), n.client_seed = window.document.getElementById("client-seed-input");
                    var e = window.document.getElementById("game_slots_lines_btns").getElementsByClassName("line");
                    for (var t in e) "object" == o(e[t]) && "button" == e[t].tagName.toLowerCase() && (n.btns_line[e[t].dataset.line] = e[t]);
                    n.view_preloader = n.container.getElementsByClassName("preloader")[0], n.label_preloader_percent = n.view_preloader.getElementsByClassName("value")[0]
                },
                init: function (e) {
                    if (n.domInit(), !n.container) return !1;
                    for (var t in n.query_data = e.query, n.query_play = e.play, n.requestAnimationFrame_get(), n.lbl_load(1), e.lines) n.lines.push(new window.game_slots_line(e.lines[t], n));
                    return n.game_id = e.game_id, n.balance_warn_text = Object(a.a)("Insufficient balance, please add more credits to play."), n.balance = parseFloat(e.balance), n.lines_count = parseInt(e.default_lines), n.min_bet = parseFloat(e.min_bet), n.max_bet = parseFloat(e.max_bet), n.bet_change_amount = parseFloat(e.bet_change_amount), n.bet = parseFloat(e.default_bet), n.updateUIText(), n.sym_ld = e.syms, n.reels = [], n.reels_ld = e.reels, n.container.classList.add(n.theme), n.theme_path = "CASINO-REFERRAL-LINK/images/games/slots/", n.animation_frames = e.animation_frames, n.animation_time = e.animation_time, n.animation_size = e.animation_size, n.animation = n.theme + "/gs-animation_200.png", n.sym_bg = n.theme + "/gs-sym_bg.png", n.res_ld = [n.theme_path + n.theme + "/gs-btn_bet_minus-active.png", n.theme_path + n.theme + "/gs-btn_bet_minus-hover.png", n.theme_path + n.theme + "/gs-btn_bet_minus.png", n.theme_path + n.theme + "/gs-btn_bet_plus-active.png", n.theme_path + n.theme + "/gs-btn_bet_plus-hover.png", n.theme_path + n.theme + "/gs-btn_bet_plus.png", n.theme_path + n.theme + "/gs-btn_max-active.png", n.theme_path + n.theme + "/gs-btn_max-hover.png", n.theme_path + n.theme + "/gs-btn_max.png", n.theme_path + n.theme + "/gs-btn_paytable-active.png", n.theme_path + n.theme + "/gs-btn_paytable-hover.png", n.theme_path + n.theme + "/gs-btn_paytable.png", n.theme_path + n.theme + "/gs-btn_sound_off-hover.png", n.theme_path + n.theme + "/gs-btn_sound_off.png", n.theme_path + n.theme + "/gs-btn_sound_on-hover.png", n.theme_path + n.theme + "/gs-btn_sound_on.png", n.theme_path + n.theme + "/gs-btn_spin-active.png", n.theme_path + n.theme + "/gs-btn_spin-hover.png", n.theme_path + n.theme + "/gs-btn_spin.png"], n.loading_cnt = 8 + n.res_ld.length + 1 + 1 + n.sym_ld.length * (1 + n.animation_time + n.speed_max / 1e3 * 2), n.loading_idx = 1, createjs.Sound.registerPlugins([createjs.WebAudioPlugin, createjs.HTMLAudioPlugin]), window.addEventListener("resize", n.resize), n.resize(), "hidden" in document ? document.addEventListener("visibilitychange", n.onchange_window_state) : "mozHidden" in document ? document.addEventListener("mozvisibilitychange", n.onchange_window_state) : "webkitHidden" in document ? document.addEventListener("webkitvisibilitychange", n.onchange_window_state) : "msHidden" in document && document.addEventListener("msvisibilitychange", n.onchange_window_state), n.load(), n
                },
                load: function (e) {
                    if (n.snd_click) if (n.snd_lose) if (n.snd_spin) if (n.snd_start) if (n.snd_stop) if (n.snd_win) {
                        var t;
                        if (n.res_ld.length > 0) return (t = new Image).onload = function () {
                            n.loading_idx++, n.lbl_load_update(), n.requestAnimationFrame(n.load)
                        }, void(t.src = n.res_ld.pop());
                        if ("object" != o(n.sym_bg)) return (t = new Image).onload = function () {
                            n.sym_bg = this, n.loading_idx++, n.lbl_load_update(), n.requestAnimationFrame(n.load)
                        }, void(t.src = n.theme_path + n.sym_bg);
                        if ("object" != o(n.animation)) return (t = new Image).onload = function () {
                            n.animation = this, n.loading_idx++, n.lbl_load_update(), n.requestAnimationFrame(n.load)
                        }, void(t.src = n.theme_path + n.animation);
                        if (n.sym_ld.length > 0) return (t = new Image).onload = function () {
                            n.loading_idx++;
                            for (var e = {
                                source: this,
                                speed_frames: [],
                                animation: []
                            }, t = 0; t <= n.speed_max / 1e3 * 2; t++) {
                                var i = Math.round(.001 * Math.pow(t, 5));
                                (o = document.createElement("canvas")).width = 200, o.height = 200 + i, (l = o.getContext("2d")).globalAlpha = 1 / (i + 1);
                                for (var s = 0; s < i + 1; ++s) l.drawImage(n.sym_bg, (200 - n.sym_bg.width) / 2, s + (200 - n.sym_bg.height) / 2);
                                for (s = 0; s < i + 1; ++s) l.drawImage(e.source, (200 - e.source.width) / 2, s + (200 - e.source.height) / 2);
                                e.speed_frames[t] = o, n.loading_idx++
                            }
                            var a = 0;
                            for (t = 0; t < n.animation_time; t++) {
                                var o, l, _ = .1 * Math.cos(4 * t * Math.PI / n.animation_time) + .9;
                                (o = document.createElement("canvas")).width = o.height = 200, (l = o.getContext("2d")).drawImage(n.animation, n.animation_size * a, 0, n.animation_size, n.animation_size, (200 - n.animation_size) / 2, (200 - n.animation_size) / 2, n.animation_size, n.animation_size), l.drawImage(e.source, (200 - e.source.width * _) / 2, (200 - e.source.height * _) / 2, e.source.width * _, e.source.height * _), e.animation[t] = o, ++a >= n.animation_frames && (a = 0), n.loading_idx++
                            }
                            n.sym.push(e), n.lbl_load_update(), n.requestAnimationFrame(n.load)
                        }, void(t.src = n.sym_ld.shift());
                        if (0 == n.container_bg.src.length) return n.container_bg.src = n.theme_path + n.theme + "/gs-bg.png", void(n.container_bg.onload = function () {
                            n.loading_idx++, n.lbl_load_update(), n.requestAnimationFrame(n.load)
                        });
                        n.loaded()
                    } else n.snd_win = new window.game_slots_sound("/audio/games/slots/win.wav", function () {
                        n.loading_idx++, n.lbl_load_update(), n.load()
                    }); else n.snd_stop = new window.game_slots_sound("/audio/games/slots/stop.wav", function () {
                        n.loading_idx++, n.lbl_load_update(), n.load()
                    }); else n.snd_start = new window.game_slots_sound("/audio/games/slots/start.wav", function () {
                        n.loading_idx++, n.lbl_load_update(), n.load()
                    }); else n.snd_spin = new window.game_slots_sound("/audio/games/slots/spin.wav", function () {
                        n.snd_spin.is_loop = !0, n.loading_idx++, n.lbl_load_update(), n.load()
                    }); else n.snd_lose = new window.game_slots_sound("/audio/games/slots/lose.wav", function () {
                        n.loading_idx++, n.lbl_load_update(), n.load()
                    }); else n.snd_click = new window.game_slots_sound("/audio/games/slots/click.wav", function () {
                        n.loading_idx++, n.lbl_load_update(), n.load()
                    })
                },
                loaded: function (e) {
                    for (var t in n.check_bet(), n.reels_ld) n.reels.push(new game_slots_reel(t, n.reels_ld[t], n));
                    for (var t in n.btn_spin.addEventListener("click", n.btn_spin_click), n.btns_line) n.btns_line[t].addEventListener("mouseover", n.btn_line_over), n.btns_line[t].addEventListener("mouseout", n.btn_line_out), n.btns_line[t].addEventListener("click", n.btn_line_click);
                    n.btn_line_plus.addEventListener("click", n.btn_line_plus_click), n.btn_line_minus.addEventListener("click", n.btn_line_minus_click), n.btn_bet_plus.addEventListener("click", n.btn_bet_plus_click), n.btn_bet_minus.addEventListener("click", n.btn_bet_minus_click), n.btn_bet_max.addEventListener("click", n.btn_bet_max_click), n.btn_sound.addEventListener("click", n.btn_sound_click), n.btn_paytable.addEventListener("click", n.btn_paytable_click), n.game_slots_paytable_data.getElementsByClassName("remove")[0].addEventListener("click", n.btn_paytable_hide_click);
                    var i = n.game_slots_paytable_data.getElementsByClassName("switcher");
                    for (var t in i) "object" == o(i[t]) && i[t].addEventListener("click", n.btn_paytable_section_click);
                    for (var t in n.reels[4].onspinned = n.game_result_request, n.reels) n.reels[t].onstopped = n.gamestop;
                    document.addEventListener("visibilitychange", n.visibility_cnage), n.t = Date.now(), n.container.classList.add("loaded"), n.run()
                },
                resize: function () {
                    n.container.offsetWidth / n.container.offsetHeight < 1.5 ? (n.container_inner.style.transform = "translate(-50%,0) scale(" + (n.container.offsetWidth / 1620).toFixed(4) + ")", n.container_inner.style.width = 1620..toFixed(8) + "px") : (n.container_inner.style.transform = "translate(-50%,0) scale(" + (n.container.offsetHeight / 1080).toFixed(4) + ")", n.container_inner.style.width = (n.container.offsetWidth / (n.container.offsetHeight / 1080)).toFixed(8) + "px")
                },
                onchange_window_state: function (e) {
                    n.requestAnimationFrame_get(), n.requestAnimationFrame(function () {
                        n.canvas.style.display = "none", n.requestAnimationFrame(function () {
                            n.canvas.style.display = "block"
                        })
                    })
                },
                lbl_load_update: function () {
                    this.loading_idx > this.loading_cnt && (this.loading_idx = this.loading_cnt), this.lbl_load(Math.round(100 * this.loading_idx / this.loading_cnt))
                },
                lbl_load: function (e) {
                    this.label_preloader_percent.textContent = e + "%"
                },
                game_result_request: function () {
                    s.a.post(n.query_play, {
                        game_id: n.game_id,
                        lines_count: n.lines_count,
                        bet: n.bet,
                        seed: n.client_seed.value || parseInt(1e6 * Math.random())
                    }).then(function (e) {
                        n.game_result = e.data, e.data.gameable.reel_positions ? (e.data.gameable.reel_positions = e.data.gameable.reel_positions.split(","), setTimeout(function () {
                            n.reels[0].stopSpin(e.data.gameable.reel_positions[0])
                        }, 0), setTimeout(function () {
                            n.reels[1].stopSpin(e.data.gameable.reel_positions[1])
                        }, 500), setTimeout(function () {
                            n.reels[2].stopSpin(e.data.gameable.reel_positions[2])
                        }, 1e3), setTimeout(function () {
                            n.reels[3].stopSpin(e.data.gameable.reel_positions[3])
                        }, 1500), setTimeout(function () {
                            n.reels[4].stopSpin(e.data.gameable.reel_positions[4])
                        }, 2e3), n.game_id = e.data.next_game.id, setTimeout(function () {
                            return n.server_hash.value = e.data.next_game.server_hash
                        }, 2e3)) : (n.reels[0].stopSpin(0), n.reels[1].stopSpin(0), n.reels[2].stopSpin(0), n.reels[3].stopSpin(0), n.reels[4].stopSpin(0))
                    }).catch(function (e) {
                    })
                },
                gamestop: function () {
                    n.is_sound && n.snd_stop.play();
                    var e = 0;
                    for (var t in n.reels) e += n.reels[t].is_spinning ? 1 : 0;
                    0 == e && (n.is_sound && n.snd_spin.stop(), n.gameshowresult())
                },
                gameshowresult: function () {
                    if (n.game_result.account.balance && (n.balance = n.game_result.account.balance), n.updateUIText(), n.win_loop = [], n.game_result.error) n.label_win.innerHTML = n.game_result.error, n.label_win_total.textContent = ""; else if (n.label_win.innerHTML = "", n.label_win_total.textContent = "", !n.game_result.gameable.scatters_count && !n.game_result.gameable.lines_win || 0 == n.game_result.win) n.label_win.innerHTML = Object(a.a)("No luck. Try again."); else {
                        if (n.game_result.gameable.scatters_count && (n.label_win.innerHTML = n.game_result.gameable.scatters_count + " " + (1 == n.game_result.gameable.scatters_count ? Object(a.a)("scatter") : Object(a.a)("scatters")) + " ", n.win_loop.push({
                                type: "scatter",
                                text: n.game_result.gameable.scatters_count + " " + (1 == n.game_result.gameable.scatters_count ? Object(a.a)("scatter") : Object(a.a)("scatters")) + "<br>" + Object(a.a)("Win") + " " + n.game_result.gameable.win_scatters_ttl
                            })), n.game_result.gameable.lines_win) for (var e in n.label_win.innerHTML += n.game_result.gameable.lines_win + " " + (1 == n.game_result.gameable.lines_win ? Object(a.a)("line") : Object(a.a)("lines")) + " ", n.game_result.gameable.win_lines) isNaN(e) || n.win_loop.push({
                            type: "line",
                            idx: e,
                            text: Object(a.a)("Line") + " " + (parseInt(e) + 1) + "<br>" + Object(a.a)("Win") + " " + n.game_result.gameable.win_lines_ttl[e]
                        });
                        for (var t in n.label_win_total.textContent = Object(a.a)("Total win " + n.game_result.win), n.game_result.gameable.win_lines) {
                            var i = n.game_result.gameable.win_lines[t];
                            for (var s in n.btns_line[parseInt(t) + 1].classList.add("blink"), n.reels) void 0 != i[s] && i[s] >= 0 && n.reels[s].win_add(i[s])
                        }
                        for (var t in n.game_result.gameable.win_scatters) {
                            var l = n.game_result.gameable.win_scatters[t];
                            if ("object" == (void 0 === l ? "undefined" : o(l)) && l.length) for (var s in l) n.reels[t].win_add(l[s])
                        }
                    }
                    n.win_loop.length ? n.is_sound && n.snd_win.play() : n.is_sound && n.snd_lose.play(), setTimeout(n.gameshowresult_demo, 2e3)
                },
                gameshowresult_demo: function () {
                    for (var e in n.reels) n.reels[e].win_clear();
                    for (var e in n.lines) n.lines[e].hide();
                    for (var e in n.btns_line) n.btns_line[e].classList.remove("blink");
                    for (var t in n.btn_spin.disabled = !1, n.btn_bet_minus.disabled = !1, n.btn_bet_plus.disabled = !1, n.btn_bet_max.disabled = !1, n.btn_line_minus.disabled = !1, n.btn_line_plus.disabled = !1, n.btns_line) n.btns_line[t].disabled = !1;
                    n.t_show_demo = -1, n.is_show_demo = !0, n.check_bet()
                },
                updateUIText: function () {
                    n.label_balance.textContent = n.balance.toFixed(2), n.label_bet.textContent = n.bet >= 1 ? Math.round(n.bet) : Math.round(10 * n.bet) / 10, n.label_lines.textContent = n.lines_count
                },
                btn_spin_click: function () {
                    for (var e in n.label_win_total.textContent = "", n.reels) n.reels[e].win_clear();
                    for (var e in n.lines) n.lines[e].hide();
                    for (var e in n.btns_line) n.btns_line[e].classList.remove("blink");
                    for (var e in n.label_win.textContent = "", n.is_show_demo = !1, n.reels) n.reels[e].win_clear();
                    for (var t in n.btn_spin.disabled = !0, n.btn_bet_minus.disabled = !0, n.btn_bet_plus.disabled = !0, n.btn_bet_max.disabled = !0, n.btn_line_minus.disabled = !0, n.btn_line_plus.disabled = !0, n.btns_line) n.btns_line[t].disabled = !0;
                    n.balance -= n.bet * n.lines_count, n.updateUIText(), n.is_sound && n.snd_start.play(), setTimeout(function () {
                        n.reels[0].startSpin(), n.is_sound && n.snd_start.play()
                    }, 0), setTimeout(function () {
                        n.reels[1].startSpin(), n.is_sound && n.snd_start.play()
                    }, 250), setTimeout(function () {
                        n.reels[2].startSpin(), n.is_sound && n.snd_start.play()
                    }, 500), setTimeout(function () {
                        n.reels[3].startSpin(), n.is_sound && n.snd_start.play()
                    }, 750), setTimeout(function () {
                        n.reels[4].startSpin(), n.is_sound && n.snd_start.play(), n.is_sound && n.snd_spin.play()
                    }, 1e3)
                },
                btn_line_over: function () {
                    for (var e in n.lines) n.lines[e].hide();
                    for (var e in n.btns_line) n.btns_line[e].classList.remove("blink");
                    n.is_line_showig = !0, n.lines[this.dataset.line - 1] && n.lines[this.dataset.line - 1].show()
                },
                btn_line_out: function () {
                    n.is_line_showig = !1, n.lines[this.dataset.line - 1] && n.lines[this.dataset.line - 1].hide()
                },
                btn_line_click: function () {
                    n.is_sound && n.snd_click.play(), n.lines_count = parseInt(this.dataset.line), n.lines_count_update()
                },
                btn_line_plus_click: function () {
                    n.is_sound && n.snd_click.play(), n.lines_count < 20 && n.lines_count++, n.lines_count_update()
                },
                btn_line_minus_click: function () {
                    n.is_sound && n.snd_click.play(), n.lines_count > 1 && n.lines_count--, n.lines_count_update()
                },
                btn_bet_minus_click: function () {
                    if (n.bet <= n.min_bet) return !1;
                    n.is_sound && n.snd_click.play(), n.bet -= n.bet_change_amount, n.check_bet(), n.updateUIText()
                },
                btn_bet_plus_click: function () {
                    if (n.bet >= n.max_bet) return !1;
                    n.is_sound && n.snd_click.play(), n.bet += n.bet_change_amount, n.check_bet(), n.updateUIText()
                },
                btn_bet_max_click: function () {
                    n.is_sound && n.snd_click.play(), n.lines_count = 20, n.bet = Math.min(n.max_bet, Math.max(n.min_bet, Math.floor(n.balance / n.lines_count))), n.check_bet(), n.updateUIText()
                },
                check_bet: function () {
                    n.bet < n.min_bet && (n.bet = n.min_bet), n.bet == n.min_bet ? n.btn_bet_minus.disabled = !0 : n.btn_bet_minus.disabled = !1, n.bet > n.max_bet && (n.bet = n.max_bet), n.bet == n.max_bet || n.lines_count * (n.bet + n.bet_change_amount) > n.balance ? n.btn_bet_plus.disabled = !0 : n.btn_bet_plus.disabled = !1, n.balance < n.lines_count * n.bet ? (n.btn_bet_plus.disabled = !0, n.btn_spin.disabled = !0, n.label_win.innerHTML = n.balance_warn_text) : (n.btn_bet_plus.disabled || (n.btn_bet_plus.disabled = !1), n.btn_spin.disabled = !1, n.label_win.innerHTML == n.balance_warn_text && (n.label_win.innerHTML = ""))
                },
                lines_count_update: function () {
                    n.check_bet(), n.lines_count_show(), n.updateUIText()
                },
                lines_count_show: function () {
                    for (var e in n.lines) n.lines[e].hide();
                    for (var t in n.lines_show_demo = n.lines_count, n.lines_show_c = 0, n.lines_show_demo_t = 1, n.btns_line) n.btns_line[t].disabled = !0
                },
                render: function () {
                    if (n.is_render_planned = !1, n.is_show_demo && n.win_loop.length > 0) {
                        for (; -1 == n.t_show_demo || n.t_show_demo > 2e3;) {
                            n.t_show_demo -= 2e3, n.t_show_demo < 0 && (n.t_show_demo = 0);
                            var e = n.win_loop.shift();
                            for (var t in n.win_loop.push(e), n.reels) n.reels[t].win_clear();
                            if (!n.is_line_showig) {
                                for (var t in n.lines) n.lines[t].hide();
                                for (var t in n.btns_line) n.btns_line[t].classList.remove("blink")
                            }
                            if ("scatter" == e.type) for (var i in n.label_win.innerHTML = e.text, n.game_result.gameable.win_scatters) {
                                var s = n.game_result.gameable.win_scatters[i];
                                if ("object" == (void 0 === s ? "undefined" : o(s)) && s.length) for (var t in s) n.reels[i].win_add(s[t])
                            } else {
                                n.label_win.innerHTML = e.text, n.is_line_showig || (n.btns_line[parseInt(e.idx) + 1].classList.add("blink"), n.lines[parseInt(e.idx)].show());
                                var a = n.game_result.gameable.win_lines[e.idx];
                                for (var t in n.reels) void 0 != a[t] && a[t] >= 0 && n.reels[t].win_add(a[t])
                            }
                        }
                        n.t_show_demo += Date.now() - n.t
                    }
                    if (-1 != n.lines_show_demo) {
                        if (n.lines_show_demo_t > 0) if (0 != n.lines_show_c && n.lines[n.lines_show_c - 1].hide(), n.lines_show_c == n.lines_show_demo) for (var i in n.lines[n.lines_show_demo - 1].show(), n.lines_show_demo = -1, n.lines_show_c = 0, n.btns_line) n.btns_line[i].disabled = !1; else n.lines[n.lines_show_c].show(), n.lines_show_c++, n.lines_show_demo_t -= 50;
                        n.lines_show_demo_t += Date.now() - n.t
                    }
                    var l = n.canvas.getContext("2d");
                    for (var i in l.clearRect(0, 0, n.canvas.width, n.canvas.height), n.t = Date.now(), n.reels) n.reels[i].draw();
                    if (!n.is_line_showig && -1 == n.lines_show_demo) for (var i in n.lines) n.lines[i].draw();
                    for (var i in n.reels) n.reels[i].drawWin();
                    if (n.is_line_showig || -1 != n.lines_show_demo) for (var i in n.lines) n.lines[i].draw();
                    for (var i in n.lines) n.lines[i].calculate();
                    for (var i in n.reels) n.reels[i].calculate()
                },
                run: function () {
                    setInterval(function () {
                        n.is_render_planned || (n.is_render_planned = !0, n.requestAnimationFrame(n.render))
                    }, 40)
                },
                btn_sound_click: function () {
                    n.is_sound ? (n.is_sound = !1, n.btn_sound.classList.add("off"), n.snd_click.stop(), n.snd_lose.stop(), n.snd_spin.stop(), n.snd_start.stop(), n.snd_stop.stop(), n.snd_win.stop()) : (n.is_sound = !0, n.btn_sound.classList.remove("off"), n.snd_click.play())
                },
                btn_paytable_click: function () {
                    n.game_slots_paytable_data.classList.add("show")
                },
                btn_paytable_section_click: function () {
                    var e = n.game_slots_paytable_data.getElementsByClassName("switcher");
                    for (var t in e) "object" == o(e[t]) && e[t].classList.remove("active");
                    this.classList.add("active");
                    var i = this.dataset.section,
                        s = n.game_slots_paytable_data.getElementsByClassName("section-paytable");
                    for (var t in s) "object" == o(s[t]) && (s[t].dataset.section == i ? s[t].classList.add("show") : s[t].classList.remove("show"))
                },
                btn_paytable_hide_click: function () {
                    n.game_slots_paytable_data.classList.remove("show")
                },
                visibility_cnage: function () {
                    if (void 0 != document.hidden) if (document.hidden) n.t_hide = Date.now(); else {
                        var e = Date.now() - n.t_hide;
                        for (var t in n.t += e, n.lines) n.lines[t].t += e;
                        for (var t in n.reels) n.reels[t].t += e
                    }
                }
            };
            return n.init(e)
        }
    }, HNiq: function (e, n, t) {
        "use strict";
        n.a = function (e) {
            return void 0 !== window.i18n && void 0 !== window.i18n[e] ? window.i18n[e] : e
        }, n.b = function (e) {
            return void 0 !== window.cfg ? function (e, n) {
                var t = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null;
                return n.split(".").reduce(function (e, n) {
                    return e && void 0 != a(e[n]) && null != e[n] ? e[n] : t
                }, e)
            }(window.cfg, e) : e
        }, n.c = function (e) {
            e.select();
            try {
                document.execCommand("copy")
            } catch (e) {
            }
            document.getSelection().removeAllRanges(), document.activeElement.blur()
        }, n.g = function (e, n, t, i) {
            new (s.a.extend(e))({propsData: i, parent: n}).$mount(t)
        }, n.e = function (e) {
            return !isNaN(parseFloat(e)) && isFinite(e)
        }, n.h = function (e) {
            var n = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 0, t = Math.pow(10, n);
            return Math.round(e * t) / t
        }, n.f = function (e, n, t) {
            e = "" + e;
            for (; e.length < t;) e = n + e;
            return e
        }, n.d = o, n.i = function (e) {
            o() ? document.exitFullscreen ? document.exitFullscreen() : document.webkitExitFullscreen ? document.webkitExitFullscreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.msExitFullscreen && document.msExitFullscreen() : e.requestFullscreen ? e.requestFullscreen() : e.mozRequestFullScreen ? e.mozRequestFullScreen() : e.webkitRequestFullScreen ? e.webkitRequestFullScreen() : e.msRequestFullscreen && e.msRequestFullscreen()
        };
        var i = t("I3G/"), s = t.n(i),
            a = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
                return typeof e
            } : function (e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            };

        function o(e) {
            return document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement
        }
    }, "Ky+F": function (e, n) {
    }, PWuC: function (e, n) {
    }, QGAl: function (e, n) {
    }, V0Fp: function (e, n) {
    }, WHGz: function (e, n) {
    }, Y2EE: function (e, n) {
    }, Z3mU: function (e, n) {
    }, ZN9n: function (e, n) {
    }, byej: function (e, n) {
    }, d0W6: function (e, n) {
    }, lFvb: function (e, n) {
    }, nTfl: function (e, n) {
    }, qJ1m: function (e, n) {
    }, rqKu: function (e, n) {
    }, ufoq: function (e, n) {
    }, viqD: function (e, n) {
    }
}, [0]);